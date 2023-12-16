$(document).ready(function () {
  $(document).on("click", "a[data-ajax]", function (event) {
    event.preventDefault();
    console.log(event);
    PubSub.publish(event.target.dataset.action, { event });
  });

  $(document).on("click", "div[data-ajax]", function (event) {
    event.preventDefault();
    PubSub.publish(event.currentTarget.dataset.action, {
      event: event.originalEvent,
    });
  });

  // PubSub.subscribe("deleteGood", function (options) {
  //   const el = options.event.target;
  //   const parent = el.closest("[data-parent]");
  //   myVar.ajaxA(el, function (response) {
  //     if (response.status == true) {
  //       parent.remove();
  //     }
  //   });
  // });

  // PubSub.subscribe("writeForm", function (options) {
  //   const target = options.event.target;
  //   const parent = target.closest("div[data-parent]");
  //   const form = parent.querySelector("form");
  //   const formData = new FormData(form);
  //   const editForm = document.querySelector("#add-good");

  //   for (const iterator of formData) {
  //     const inputName = iterator[0];
  //     const inputValue = iterator[1];

  //     const editInput = editForm.querySelector(`input[name="${inputName}"]`);
  //     if (editInput) {
  //       editInput.value = inputValue;

  //       if (inputName.match("image")) {
  //         const image = editForm.querySelector("img");
  //         image.src = inputValue;
  //       }

  //       if (editInput.type == "hidden") {
  //         const next = editInput.nextElementSibling;
  //         const checkbox = next.querySelector('input[type="checkbox"]');
  //         if (checkbox) {
  //           if (inputValue == 1) {
  //             checkbox.checked = true;
  //           } else {
  //             checkbox.checked = false;
  //           }
  //         }
  //       }
  //     }
  //   }
  //   /*
  //       myVar.ajaxA(el, function(response){
  //           if (response.status == true) {
  //               parent.remove();
  //           }
  //       });
  //       */
  // });

  // PubSub.subscribe("activateTree", function (options) {
  //   OnOffButton();
  //   console.log(options);
  //   if (options.data.node.folder == true) {
  //     myVar.ajax(function (data) {
  //       console.log(data);
  //       indexHtmlBrand(data, false);
  //     }, options.urlCategory);
  //   } else {
  //   }
  // });

  function indexHtmlBrand(data, d = true, f = true) {
    if (d) {
      $("#box-body-tree").html(data.content[0].tree);
    }
    if (f) {
      $("#data-modal").html(data.content[0].category);
      $("#data-modal-good").html(data.content[0].goods);
    }
  }

  $(document).on("beforeSubmit", "#add-good", function (event) {
    event.preventDefault();

    myVar.ajaxForm(event.target, function (response) {
      if (response.status) {
        $("#goods-list").html(response.content);
        event.target.reset();
        const image = event.target.querySelector("img");
        image.src = "";
      } else {
        const attributes = $(event.target).yiiActiveForm("data").attributes;
        for (const attr of attributes) {
          if (response.errors[attr.name] != undefined) {
            const container = event.target.querySelector(attr.container);
            container.classList.remove("has-success");
            container.classList.add("has-error");
            const helpBlock = container.querySelector(attr.error);
            helpBlock.innerText = response.errors[attr.name][0];
          }
        }
      }
    });

    return false;
  });

  $("input[name=search]")
    .keyup(function (e) {
      var n,
        tree = $.ui.fancytree.getTree(),
        match = $(this).val(),
        filterFunc = tree.filterBranches;
      filterFunc.call(tree, match);

      if ((e && e.which === $.ui.keyCode.ESCAPE) || $.trim(match) === "") {
        $("button#btnResetSearch").click();
        return;
      }
    })
    .focus();

  $(document).on("click", "[data-button-tree]", function (e) {
    e.preventDefault();
    let t = $(this).attr("data-button-tree");
    console.log(t);

    if (myVar.idTree === 0 && t !== "create") {
      myModal.info.show("Выберите продукцию");
    } else {
      switch (t) {
        case "down":
          sort(this);
          break;
        case "up":
          sort(this);
          break;
        case "right":
          break;
        case "left":
          goBrand(this);
          break;
        case "create":
          createBrand(this);
          break;
        case "update":
          updateBrand(this);
          break;
        case "delete":
          if (confirm("Удалить категорию?")) {
            goBrand(this);
            myVar.idTree = 0;
            OnOffButton(false);
          }
          break;
      }
    }
    return false;
  });

  function sort(element, f = true) {
    let href = element.href;

    myVar.ajax(function (data) {
      if (data.status) {
        if (f) {
          indexHtmlBrand(data, true, false);
        }
      } else {
        myModal.info.show(data.content, "Предупреждение", 3000);
      }
    }, href + "?id=" + myVar.idTree);
  }

  function goBrand(element, f = true) {
    let href = element.href;
    myVar.ajax(function (data) {
      if (data.status) {
        if (f) {
          indexHtmlBrand(data, true, false);
        } else {
          indexHtmlBrand(data);
        }
      } else {
        myModal.info.show(data.text, "Предупреждение", 3000);
      }
    }, href + "?id=" + myVar.idTree);
  }

  function createBrand(element) {
    let href = element.href;
    myVar.ajax(function (data) {
      if (data.status) {
        myModal.panel.close();
        myModal.panel.text(data.content);
        myVar.ligh();
      }
    }, href);
  }

  function htmlGoods(data) {
    $("#data-modal-good").html(data.text[0].goods);
  }

  function updateBrand(element) {
    let href = element.href;

    myVar.ajax(function (data) {
      if (data.status) {
        myModal.panel.close();
        myModal.panel.text(data.text);
        myVar.ligh();
      }
    }, href + "?id=" + myVar.idTree);
  }

  /* Отправка форм для сохрания нового и отредактированного*/
  $(document).on(
    "beforeSubmit",
    "#category-create, #category-update",
    function (e) {
      e.preventDefault();
      myVar.ajaxForm(this, function (data) {
        if (data.status) {
          indexHtmlBrand(data);
          myModal.panel.close();
          myVar.ligh();
        } else {
          myModal.info.show(data.text, "Ошибка сохранения");
        }
      });
      return false;
    }
  );

  $(document).on("beforeSubmit", "#category-edit", function (event) {
    myVar.ajaxForm(this, function (response) {
      indexHtmlBrand(response, true);
    });
    return false;
  });

  function OnOffButton(d = true) {
    $("[data-button-no-active-pr]").each(function (i, e) {
      $(e).attr("data-button-no-active-pr", !d);
    });
  }

  $(document).on("click", "[data-update-property]", function (e) {
    e.preventDefault();
    let href = this.href;
    myVar.ajax(function (data) {
      if (data.status) {
        myModal.panel.close();
        myModal.panel.text(data.text);
      } else {
        myModal.info.show(data.text, "Ошибка");
      }
    }, href);
    return false;
  });

  $(document).on("click", "[data-update-good-sort]", function (e) {
    e.preventDefault();
    let href = this.href;
    myVar.ajax(function (data) {
      if (data.status) {
        htmlGoods(data);
      } else {
        myModal.info.show(data.text, "Ошибка");
      }
    }, href);
    return false;
  });

  $(document).on("click", "[data-count-tr]", function (e) {
    e.preventDefault();
    let href = this.href + "&count=" + $(this).attr("data-count-tr");
    let f = this;
    myVar.ajax(function (data) {
      if (data.status) {
        $("#tbody-property-add-tr").append(data.text);
        $(f).attr("data-count-tr", data.count);
      } else {
        myModal.info.show(data.text, "Ошибка");
      }
    }, href);
    return false;
  });

  $(document).on("click", "[data-delete-tr-property]", function (e) {
    $(this).parent().parent().remove();
  });

  $(document).on("change", "[data-count-td-property]", function (e) {
    e.preventDefault();
    let t = this;
    myVar.ajax(function (data) {
      $(
        "[data-count-td-value='" + $(t).attr("data-count-td-property") + "']"
      ).html(data.text);
    }, $(t).attr("data-url") + "?id=" + t.value);
    return false;
  });

  $(document).on("submit", "#form-save-property", function (e) {
    e.preventDefault();
    myVar.ajaxForm(this, function (data) {
      if (data.status) {
        myModal.panel.close();
        $("#data-modal-good").html(data.text);
      } else {
        myModal.info.show(data.text, "Ошибка");
      }
    });
    return false;
  });

  $(document).on("click", "[data-delete-goods]", function (e) {
    e.preventDefault();
    if (confirm("Вы уверены что хотите удалить данную позицию?")) {
      myVar.ajaxA(this, function (data) {
        if (data.status) {
          $("#data-modal-good").html(data.text);
        }
      });
    }
    return false;
  });

  $(document).on("click", "[data-add-goods]", function (e) {
    e.preventDefault();
    myVar.ajaxA(this, function (data) {
      if (data.status) {
        myModal.panel.close();
        myModal.panel.text(data.text);
      }
    });
    return false;
  });

  $(document).on("click", "[data-unite-goods]", function (e) {
    e.preventDefault();
    let dataCh = $("[data-checkbox]:checked");
    if (dataCh.length < 2) {
      myModal.info.show(
        "Выделить больше одного товара",
        "Предупреждение",
        3000
      );
    } else {
      if (confirm("Объединить выбранные элементы?")) {
        let data = new FormData();
        let t = this;
        for (let i = 0; i < dataCh.length; i++) {
          data.append("id[]", dataCh[i].value);
        }
        myVar.ajax(
          function (data) {
            if (data.status) {
              $("#data-modal-good").html(data.text);
            } else {
              myModal.info.show(data.text, "Ошибка");
            }
          },
          t.href,
          data
        );
      }
    }
    return false;
  });
});
