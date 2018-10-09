	(function() {

	"use strict";

	BX.namespace("BX.UI");

	/**
	 *
	 * @param {object} options
	 * @param {Element} options.targetElement
	 * @param {Element} options.inputElement
	 * @param {Array} options.items
	 * @param {String} [options.ajaxUrl]
	 * @param {object} [options.events<string, function>]
	 * @constructor
	 */
	BX.UI.Dropdown = function(options)
	{
		this.popupWindow = null;
		this.items = [];
		this.defaultItems = [];
		this.itemsContainer = null;
		this.popupConatiner = null;
		this.footerItems = null;
		this.targetElement = options.targetElement;

		this.searchAction = BX.prop.getString(options, "searchAction", "");
		this.searchOptions = BX.prop.getObject(options, "searchOptions", {});

		this.messages = BX.prop.getObject(options, "messages", {});

		this.isChanged = false;
		this.enableCreation = BX.prop.getBoolean(options, "enableCreation", false);

		this.events = options.events || {};
		this.updateItemsList(options.items);
		this.setDefaultItems(options.items);
		this.setFooterItems(options.footerItems);
		// this.init();

		if (this.targetElement !== 'undefined')
		{
			this.init();
		}
	};

	BX.UI.Dropdown.prototype =
		{
			init: function ()
			{
				this.targetElement.addEventListener("click", function()
				{
					if(this.popupWindow)
					{
						BX.PreventDefault();
					}

					this.getPopupWindow().show();
				}.bind(this), true);

				this.targetElement.addEventListener("focus", function()
				{
					this.getPopupWindow().show();
				}.bind(this), true);

				this.targetElement.addEventListener("blur", function()
				{
					this.getPopupWindow().show();
				}.bind(this), true);


				BX.bind(
					this.targetElement,
					"keyup",
					BX.throttle(
						function(e) {

							if(this.targetElement.value === '')
							{
								return;
							}

							if(e.key === "Escape")
							{
								if(this.targetElement.value !== '' && !this.popupWindow)
								{
									this.getPopupWindow().show();
								}
								else {
									BX.PreventDefault();
								}
							}

							if(!this.enableCreation) {
								this.targetElement.addEventListener("keyup", function(e)
								{
									if(e.key === "Escape")
									{
										this.resetInputValue();
									}
								}.bind(this));

								window.addEventListener('click', function(e)
								{
									if(e.target !== this.targetElement)
									{
										this.resetInputValue();
									}
								}.bind(this))
							}

						}.bind(this),
						2000
					)
				);

				this.targetElement.addEventListener("keyup", function(e)
				{
					if (e.keyCode === 40)
					{
						this.handleDownArrow();
					}
					else if (e.keyCode === 38)
					{
						this.handleUpArrow();
					}
					else if (e.keyCode === 13)
					{
						if(this.highlightedItem)
						{
							this.handleItemClick(this.highlightedItem);
						}
					}
					else
					{
						this.handleTypeInField();
						//this.targetElement.addEventListener("input", BX.debounce(this.handleTypeInField.bind(this), 500), true);
					}

					if(this.targetElement.value !== '' && !this.popupWindow)
					{
						this.getPopupWindow().show();
					}
					if(this.popupWindow && e.keyCode === 13)
					{
						this.getPopupWindow().close();
					}
				}.bind(this));

				if (this.events)
				{
					for (var eventName in this.events)
					{
						if (BX.type.isFunction(this.events[eventName]))
						{
							BX.addCustomEvent(this, "BX.UI.Dropdown:" + eventName, this.events[eventName]);
						}
					}
				}
			},
			getDefaultItems: function()
			{
				return this.defaultItems;
			},
			setDefaultItems: function(defaultItems)
			{
				this.defaultItems = defaultItems;
			},
			getItems: function()
			{
				return this.items;
			},
			updateItemsList: function (items)
			{
				this.setDefaultItems(items);
				this.setItems(items);
				for (var i = 0; i < items.length; i++)
				{
					items[i].searchField = items[i].title + items[i].subtitle + items[i].phone + items[i].email;
					items[i].searchField = items[i].searchField.toLowerCase();
				}
			},
			setItems: function(items)
			{
				this.items = items;
				if (this.popupWindow)
				{
					this.renderItemsToInnerContainer();
				}
			},
			handleTypeInField: function()
			{
				if(!this.isChanged) {
					this.isChanged = true;
				}

				var loader = this.getItemsListContainer();

				if (!this.targetElement.value)
				{
					this.setItems(this.getDefaultItems());
					loader.classList.remove('ui-dropdown-loader-active');
					BX.cleanNode(this.popupAlertContainer);
					this.alertEmptyContainer = null;

					BX.onCustomEvent(this, "BX.UI.Dropdown:onReset", [this]);
				}
				else if(this.targetElement.value.length >= 3)
				{
					//this.setItems(this.searchItemsByStr(this.targetElement.value));
					this.searchItemsByStr(this.targetElement.value).then(
						function (items)
						{
							if(!this.alertEmptyContainer)
							{
								this.popupAlertContainer.appendChild(this.getAlertEmptyContainer(items));
							}
							this.setItems(items);
							loader.classList.remove('ui-dropdown-loader-active');

						}.bind(this)
					);

					loader.classList.add('ui-dropdown-loader-active');
				}

				if(!this.targetElement.value)
				{
					this.popupAlertContainer.style.display = "none";
				}
				else
				{
					this.popupAlertContainer.style.display = ""
				}
			},
			searchItemsByStr: function(target)
			{
				return BX.ajax.runAction(
					this.searchAction,
					{ data: { search: target, options: this.searchOptions } }
				).then(this.onSearchRequestSuccess.bind(this));
			},
			onSearchRequestSuccess: function(results)
			{
				return BX.prop.getArray(results, "data", []);
			},
			getFooterItems: function()
			{
				return this.footerItems;
			},
			setFooterItems: function(items)
			{
				if (Array.isArray(items))
				{
					this.footerItems = items;
				}
			},
			getPopupWindow: function()
			{
				if (!this.popupWindow)
				{
					this.popupWindow = new BX.PopupWindow("dropdown", this.targetElement, {
						autoHide: true,
						content : this.popupConatiner ? this.popupContainer : this.getPopupContainer(),
						contentColor : "white",
						closeByEsc: true,
						className: "ui-dropdown-window",
						events: {
							onPopupClose: function()
							{
								this.popupWindow.destroy();
								this.popupWindow = null;
							}.bind(this)
						}
					});
				}

				this.setWidthPopup();
				BX.bind(window, "resize", this.setWidthPopup.bind(this));

				return this.popupWindow;
			},
			setWidthPopup: function()
			{
				if(this.popupWindow && this.targetElement)
				{
					this.popupWindow.popupContainer.style.width = this.targetElement.offsetWidth + "px"
				}
			},
			onEmptyValueEvent: function()
			{
				if(this.enableCreation)
				{
					BX.onCustomEvent(this, "BX.UI.Dropdown:onAdd", [this, { title: this.targetElement.value }]);

					this.setItems(this.getDefaultItems());
					BX.cleanNode(this.popupAlertContainer);
					this.alertEmptyContainer = null;
				}
				else
				{
					this.resetInputValue();
				}
			},
			resetInputValue: function() {
				this.targetElement.value = "";

				BX.onCustomEvent(this, "BX.UI.Dropdown:onReset", [this]);
			},
			destroyPopupWindow: function()
			{
				if(!this.popupWindow) {
					return;
				}

				this.popupWindow.close();
			},
			getPopupContainer: function()
			{
				this.popupContainer = this.getItemsListContainer();

				this.popupContainer.appendChild(this.getItemsListInnerContainer());
				this.popupContainer.appendChild(this.getPopupAlertContainer());

				this.renderItemsToInnerContainer();
				if (this.footerItems)
				{
					this.popupContainer.appendChild(this.getLoaderContainer());
					this.popupContainer.appendChild(this.getFooterContent());
				}

				return this.popupContainer;
			},
			getPopupAlertContainer: function()
			{

				if(!this.popupAlertContainer)
				{
					this.popupAlertContainer = BX.create("div", {
						attrs: { className: 'ui-dropdown-alert-container' }
					});
				}

				return this.popupAlertContainer;
			},
			getAlertEmptyContainer: function(items)
			{
				if(!this.alertEmptyContainer)
				{
					this.alertEmptyContainer = BX.create('div', {
						props: {
							className: 'ui-dropdown-alert-new'
						},
						events: {
							click: this.onEmptyValueEvent.bind(this)
						},
						children: [
							this.alertEmptyContainerValue = BX.create('div', {
								attrs: { className: 'ui-dropdown-alert-new-name' },
								text: this.targetElement.value
							}),
							BX.create('div', {
								attrs: { className: 'ui-dropdown-alert-new-text' },
								text: BX.prop.getString(this.messages, this.enableCreation ? "creationLegend" : "notFound", "")
							})
						]
					});

					this.targetElement.addEventListener("input", function()
					{
						this.alertEmptyContainerValue.innerHTML = this.targetElement.value;
					}.bind(this));

					if(!this.enableCreation)
					{
						this.targetElement.addEventListener("input", function()
						{
							this.alertEmptyContainerValue.style.display = "none";
						}.bind(this));
					}
				}

				if(items.length > 0 && !this.enableCreation)
				{
					this.alertEmptyContainer.style.display = "none";
				}
				else
				{
					this.alertEmptyContainer.style.display = "";
				}

				return this.alertEmptyContainer;
			},
			getItemsListContainer: function()
			{
				if(!this.itemListContainer)
				{
					this.itemListContainer = BX.create('div', {
						attrs: {
							className: 'ui-dropdown-container'
						}
					});
				}
				return this.itemListContainer;
			},
			getItemsListInnerContainer: function()
			{
				if(!this.itemListInnerContainer)
				{
					this.itemListInnerContainer = BX.create('div', {
						attrs: {
							className: 'ui-dropdown-inner'
						}
					});
				}
				return this.itemListInnerContainer;
			},
			getItemNodeList: function()
			{
				var result = [];

				this.getItems().forEach(function(item)
				{

					var email;
					var phone;

					if(Array.isArray(item.email)) {
						email = item.email[0].value;
					}

					if(Array.isArray(item.phone)) {
						phone = item.phone[0].value;
					}

					item.node = BX.create('div', {
						attrs: {
							className: 'ui-dropdown-item'
						},
						events: {
							click: this.handleItemClick.bind(this, item)
						},
						children: [
							BX.create('div', {
								attrs: {
									className: 'ui-dropdown-item-name'
								},
								text: item.title
							}),
							BX.create('div', {
								attrs: {
									className: 'ui-dropdown-item-subname'
								},
								text: item.subtitle
							}),
							BX.create('div', {
								attrs: {
									className: 'ui-dropdown-contact-info'
								},
								children: [
									item.phone ? BX.create('div', {
										attrs: {
											className: 'ui-dropdown-contact-info-item ui-dropdown-item-phone'
										},
										text: phone ? phone : item.phone
									}) : null,
									item.email ? BX.create('div', {
										attrs: {
											className: 'ui-dropdown-contact-info-item ui-dropdown-item-email'
										},
										text: email ? email : item.email
									}) : null
								]
							})
						]
					});
					result.push(item.node);
				}, this);

				return result;
			},
			renderItemsToInnerContainer: function()
			{
				var innerContainer = this.getItemsListInnerContainer();
				BX.cleanNode(innerContainer);

				var itemsNodeList = this.getItemNodeList();
				// var itemAlertNode = this.getPopupAlertContainer();

				for (var i = 0; i < itemsNodeList.length; i++)
				{
					innerContainer.appendChild(itemsNodeList[i]);
				}

				// innerContainer.appendChild(itemAlertNode);

				return innerContainer;
			},
			getLoaderContainer: function()
			{
				return BX.create('div', {
					props: {
						className: 'ui-dropdown-loader-container'
					},
					html: '<svg class="ui-dropdown-loader" viewBox="25 25 50 50"><circle class="ui-dropdown-loader-path" cx="50" cy="50" r="20" fill="none" stroke-miterlimit="10"></circle><circle class="ui-dropdown-loader-inner-path" cx="50" cy="50" r="20" fill="none" stroke-miterlimit="10"></circle></svg>'
				})
			},
			getFooterContent: function()
			{

				var footerContainer = BX.create('div', {

				});

				this.getFooterItems().forEach(function(footerItem)
				{

					var footer = BX.create('div', {
						attrs: {
							className: 'ui-dropdown-footer'
						},
						children: [
							BX.create('div', {
								attrs: {
									className: 'ui-dropdown-caption-box'
								},
								children: [
									BX.create('div', {
										attrs: {
											className: 'ui-dropdown-caption'
										},
										text: footerItem.caption
									})
								]
							})
						]
					});
					footerItem.buttons.forEach(function(button)
					{
						footer.appendChild(
							BX.create('div', {
								attrs: {
									className: 'ui-dropdown-button-add'
								},
								text: button.caption,
								events: button.events
							})
						);
					});
					footerContainer.appendChild(footer);

				});

				return footerContainer;
			},
			handleDownArrow: function()
			{
				var items = this.getItems();
				if (!items)
				{
					return;
				}

				var highlightElementIndex = this.getHighlightItemIndex();
				var itemToHighlight = null;
				if (highlightElementIndex === null)
				{
					itemToHighlight = this.getFirstItem();
				}
				else
				{
					this.cleanHighlightingItem();
					if (items.length >= highlightElementIndex + 1)
					{
						itemToHighlight = this.getItemByIndex(highlightElementIndex+1);
					}
				}
				if (itemToHighlight)
				{
					this.highlightItem(itemToHighlight);
				}

			},
			scrollToItem: function()
			{
				var parent = this.getItemsListInnerContainer();
				var parentBounding = parent.getBoundingClientRect();
				var elemBounding = this.highlightedItem.node.getBoundingClientRect();
				var deltaBottom = parentBounding.bottom - elemBounding.bottom;
				var deltaTop = parentBounding.top - elemBounding.top;

				if(deltaBottom < 0)
				{
					parent.scrollTop = parent.scrollTop + Math.abs(deltaBottom)
				} else if(deltaTop > 0)
				{
					parent.scrollTop = parent.scrollTop - deltaTop
				}
			},
			highlightItem: function(item)
			{
				item.node.classList.add('ui-dropdown-item-highlight');
				// this.getItemsListInnerContainer().scrollTop = item.node.offsetTop;
				this.highlightedItem = item;

				this.scrollToItem();
			},
			cleanHighlightingItem: function()
			{
				if (this.highlightedItem)
				{
					this.highlightedItem.node.classList.remove('ui-dropdown-item-highlight');
				}

				this.highlightedItem = null;
			},
			getHighlightItemIndex: function()
			{
				var result = null;
				var items = this.getItems();
				for (var i = 0; i < items.length; i++) {
					if (items[i].node.classList.contains('ui-dropdown-item-highlight'))
					{
						return i
					}
				}
				return result;
			},

			getItemIndex: function(item)
			{
				var items = this.getItems();
				for (var i = 0; i < items.length; i++)
				{
					if (items[i] === item)
					{
						return i;
					}
				}
				return false;
			},
			getFirstItem:  function()
			{
				var items = this.getItems();
				if (!items)
				{
					return;
				}

				return items[0];
			},
			getLastItem:  function()
			{
				var items = this.getItems();
				if (!items)
				{
					return;
				}

				return items[items.length - 1];
			},
			getItemByIndex: function(index)
			{
				var items = this.getItems();
				if (items[index])
				{
					return items[index];
				}
				return null;
			},
			handleUpArrow: function()
			{
				var items = this.getItems();
				if (!items)
				{
					return;
				}

				var highlightElementIndex = this.getHighlightItemIndex();
				var itemToHighlight = null;
				if (highlightElementIndex === null)
				{
					itemToHighlight = this.getLastItem();
				}
				else
				{
					this.cleanHighlightingItem();

					if (items.length >= highlightElementIndex + 1)
					{
						itemToHighlight = this.getItemByIndex(highlightElementIndex-1);
					}
				}
				if (itemToHighlight)
				{
					this.highlightItem(itemToHighlight);
				}
			},
			getNewItems: function()
			{
				BX.ajax.action({
					action: 'dasdasdasd.php',
					data: this.targetElement.value,
					onsuccess: function(result) {
						this.setDefaultItems(result.data.items)
					}.bind(this)
				})
			},
			setNewItemsForTest: function()
			{
				var newItems = [
					{ title: "Pasha", subtitle: "developer", phone: "+7 965 954-64-24,", email: "rosros@mail.ru" },
					{ title: "Lesha", subtitle: "developer", phone: "+7 965 954-64-24,", email: "rosros@mail.ru" },
					{ title: "Kolya", subtitle: "developer", phone: "+7 965 954-64-24,", email: "rosros@mail.ru" },
					{ title: "UserName", subtitle: "developer", phone: "+7 965 954-64-24,", email: "rosros@mail.ru" },
					{ title: "UserName", subtitle: "developer", phone: "+7 965 954-64-24,", email: "rosros@mail.ru" },
					{ title: "UserName", subtitle: "developer", phone: "+7 965 954-64-24,", email: "rosros@mail.ru" },
					{ title: "UserName", subtitle: "developer", phone: "+7 965 954-64-24,", email: "rosros@mail.ru" },
					{ title: "UserName", subtitle: "developer", phone: "+7 965 954-64-24,", email: "rosros@mail.ru" }
				];
				this.updateItemsList(newItems);
				return this.getItems();
			},

			handleItemClick: function(item, event)
			{
				if(this.isChanged) {
					this.isChanged = false;
				}
				BX.onCustomEvent(this, "BX.UI.Dropdown:onSelect", [this, item]);
			}
		};


	BX.UI.DropdownUser = function(options)
	{
		BX.UI.Dropdown.call(this, options);
	};


	BX.UI.DropdownUser.prototype =
		{
			__proto__: BX.UI.Dropdown.prototype,

			renderItem: function(item)
			{

				itemsContainer.appendChild(BX.create('div', {
					attrs: {
						className: 'ui-dropdown-item ui-dropdown-item-user'
					},
					children: [
						BX.create('div', {
							attrs: {
								className: 'ui-dropdown-item-icon'
							},
							text: item.user
						}),
						BX.create('div', {
							attrs: {
								className: 'ui-dropdown-info-box'
							},
							children: [
								BX.create('div', {
									attrs: {
										className: 'ui-dropdown-item-name'
									},
									text: item.title
								}),
								BX.create('div', {
									attrs: {
										className: 'ui-dropdown-item-subname'
									},
									text: item.subtitle
								}),
								BX.create('div', {
									attrs: {
										className: 'ui-dropdown-item-value'
									},
									text: item.value
								})
							]
						})
					]
				}))

			}
		};

})();

// var cl = BX.getClass("BX.Crm.ClientEditorEntityPanel");
// var obj = new cl({});