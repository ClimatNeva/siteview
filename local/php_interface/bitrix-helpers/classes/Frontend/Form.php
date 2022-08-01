<?php
namespace BH\Frontend;
class Form extends \CBitrixComponentTemplate
{

	/** @var \CBitrixComponentTemplate $parent */
	public $component;

	/** @var array $arParams */
	public $arParams;

	/** @var string $type */
	public $type;

	/** @var array $jsProps */
	public $jsProps;

	/**
	 * Создаём класс, основываясь на текущем компоненте/шаблоне
	 *
	 * @param \CBitrixComponentTemplate $parent
	 * @param                          $type
	 */
	public function __construct(\CBitrixComponentTemplate $parent, $type)
	{
		$parent->__construct();
		$this->component = $parent->getComponent();
		$this->arParams = $parent->getComponent()->arParams;

		$this->type = $type;

		foreach ($this->component->arResult['ITEMS'] as $item) {
			$this->component->arResult['CODE_TO_ID'][$item['CODE']] = $item['ID'];
		}
	}

	/**
	 * Вынесенный в функцию foreach($arResult['ITEMS'] as $item) перебор свойств для вывода их в произвольных местах и
	 * произвольном порядке
	 *
	 * @param string $id
	 *
	 * @return void
	 * @internal param array $params
	 *
	 */
	public function getPropertyHTML($id = '')
	{
	    global $APPLICATION;
		// Если код, а не ID
		if (intval($id) == 0) {
			$id = self::getIdByCode($id);
		}

		// CODE_TO_ID собирается в result_modifier, чтобы потом вызывать эту функцию по коду свойства, а не по ID
		$arItem = $this->component->arResult['ITEMS'][$id];
		$key = $arItem['ID'];

		$params = $this->checkParams($arItem);

		if ($params['skip'] === true)
			return;

		// Пустые значения
		if (empty($arItem['VALUES']) || isset($arItem['PRICE']))
			return;

		// Нет разницы в значениях максимального и минимального
		if ($arItem['DISPLAY_TYPE'] == 'A' && ($arItem['VALUES']['MAX']['VALUE'] - $arItem['VALUES']['MIN']['VALUE'] <= 0))
			return;

		// Кастомное название свойства
		if (isset($params['title']))
			$arItem['NAME'] = $params['title'];

		$expanded = false;
		$visible = true;

		switch ($this->type) {
			case 'index':
				$expanded = in_array($key, explode(',', $_REQUEST['expanded'])) || $arItem['DISPLAY_EXPANDED'] == 'Y';
				break;

			case 'result':
				$expanded = true;
				break;
		}

		$arValues = current($arItem['VALUES']);

		if ($params['type'] == 'singleCheckbox')
			$visible = false;

		$expanded = $visible && $expanded;

		/*if ($this->type == 'result') {
			Registry::getInstance()->add('Form', $arItem, $arItem['CODE']);
		}*/

		?>
        <div class="row prop-row <?= $expanded ? 'bx-active' : '' ?>" data-code="<?= $arItem['CODE'] ?>">
            <div class="bx-filter-parameters-box <?= $expanded ? 'bx-active' : '' ?> ">

				<? if ($visible) { ?>
                    <div class="bx-filter-block-arr js-arrow">
                        <i data-role="prop_angle" class="fa fa-angle-<?= $expanded ? 'up' : 'down' ?>"></i>
                    </div>
				<? } ?>

				<?php
				if (isset($params['type'])) {
					switch ($params['type']) {
						case 'singleCheckbox':
							$arValue = $arItem['VALUES']['Y'];
							?>
                            <div class="bx-filter-parameters-box-check">
                                <div class="checkbox">
                                    <input
                                            type="checkbox"
                                            value="<?= $arValue['HTML_VALUE'] ?>"
                                            name="<?= $arValue['CONTROL_NAME'] ?>"
                                            id="<?= $arValue['CONTROL_ID'] ?>"
										<?= $arValue['CHECKED'] ? 'checked="checked"' : '' ?>
                                            onclick="smartFilter.click(this);"
                                    />

                                    <label data-role="label_<?= $arValue['CONTROL_ID'] ?>"
                                           class="bx-filter-param-label <?= $arValue['DISABLED'] ? 'disabled' : '' ?>"
                                           for="<?= $arValue['CONTROL_ID'] ?>">
                                    </label>
                                </div>
                            </div>
							<?
							$this->getNameBlock($arItem, $params['type']);
							break;
					}
				}
				else {

					$this->getNameBlock($arItem, $params['type']);
					?>

                    <div class="col-sm-11 col-sm-offset-1 bx-filter-block" data-role="bx_filter_block">
                        <div class="bx-filter-parameters-box-container">
							<?

							switch ($arItem['DISPLAY_TYPE']) {
							case 'A'://NUMBERS_WITH_SLIDER
								?>
                                <div class="col-xs-5 bx-filter-parameters-box-container-block bx-left">
                                    <i class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_FROM") ?></i>
                                    <div class="bx-filter-input-container">
                                        <input
                                                class="min-price"
                                                type="text"
                                                name="<?= $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                id="<?= $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                value="<?= $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                size="5"
                                                onkeyup="smartFilter.keyup(this);"
                                        />
                                    </div>
                                </div>
                                <div class="col-xs-5 bx-filter-parameters-box-container-block bx-right">
                                    <i class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_TO") ?></i>
                                    <div class="bx-filter-input-container">
                                        <input
                                                class="max-price"
                                                type="text"
                                                name="<?= $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                id="<?= $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                value="<?= $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                size="5"
                                                onkeyup="smartFilter.keyup(this);"
                                        />
                                    </div>
                                </div>

                                <div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
                                    <div class="bx-ui-slider-track" id="drag_track_<?= $key ?>">
										<?
										$precision = $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0;
										$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
										$value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
										$value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
										$value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
										$value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
										$value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
										?>
                                        <div class="bx-ui-slider-part p1"><span><?= $value1 ?></span></div>
                                        <div class="bx-ui-slider-part p2"><span><?= $value2 ?></span></div>
                                        <div class="bx-ui-slider-part p3"><span><?= $value3 ?></span></div>
                                        <div class="bx-ui-slider-part p4"><span><?= $value4 ?></span></div>
                                        <div class="bx-ui-slider-part p5"><span><?= $value5 ?></span></div>

                                        <div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;"
                                             id="colorUnavailableActive_<?= $key ?>"></div>
                                        <div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;"
                                             id="colorAvailableInactive_<?= $key ?>"></div>
                                        <div class="bx-ui-slider-pricebar-v" style="left: 0;right: 0;"
                                             id="colorAvailableActive_<?= $key ?>"></div>
                                        <div class="bx-ui-slider-range" id="drag_tracker_<?= $key ?>"
                                             style="left: 0;right: 0;">
                                            <a class="bx-ui-slider-handle left" style="left:0;"
                                               href="javascript:void(0)" id="left_slider_<?= $key ?>"></a>
                                            <a class="bx-ui-slider-handle right" style="right:0;"
                                               href="javascript:void(0)" id="right_slider_<?= $key ?>"></a>
                                        </div>
                                    </div>
                                </div>
							<?
							$arJsParams = array("leftSlider" => 'left_slider_' . $key, "rightSlider" => 'right_slider_' . $key, "tracker" => "drag_tracker_" . $key, "trackerWrap" => "drag_track_" . $key, "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"], "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"], "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"], "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"], "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"], "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"], "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"], "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"], "precision" => $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0, "colorUnavailableActive" => 'colorUnavailableActive_' . $key, "colorAvailableActive" => 'colorAvailableActive_' . $key, "colorAvailableInactive" => 'colorAvailableInactive_' . $key,);
							?>
                                <script type="text/javascript">
									BX.ready(function () {
										window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
									});
                                </script>
							<?
							break;
							case 'B'://NUMBERS

							?>
                                <div class="col-xs-5 bx-filter-parameters-box-container-block bx-left">
                                    <div class="bx-filter-input-container">
                                        <input
                                                class="min-price"
                                                type="text"
                                                name="<?= $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                id="<?= $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                value="<?= $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                size="5"
                                                onkeyup="smartFilter.keyup(this);"
                                                placeholder="<?= GetMessage("CT_BCSF_FILTER_FROM") ?> <?= $arItem["VALUES"]["MIN"]["VALUE"] ?>"
                                        />
                                    </div>
                                </div>

								<?php
								if (isset($params['second'])) {

									if (intval($params['second']) == 0) {
										$params['second'] = self::getIdByCode($params['second']);
									}
									$arItem = $this->component->arResult['ITEMS'][$params['second']];
								}
								?>

                                <div class="col-xs-5 bx-filter-parameters-box-container-block bx-right">
                                    <div class="bx-filter-input-container">
                                        <input
                                                class="max-price"
                                                type="text"
                                                name="<?= $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                id="<?= $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                value="<?= $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                size="5"
                                                onkeyup="smartFilter.keyup(this);"
                                                placeholder="<?= GetMessage("CT_BCSF_FILTER_TO") ?> <?= $arItem["VALUES"]["MAX"]["VALUE"] ?>"
                                        />
                                    </div>
                                </div>
							<?
							break;
							case 'G'://CHECKBOXES_WITH_PICTURES
							?>
                                <div class="bx-filter-param-btn-inline">
									<? foreach ($arItem["VALUES"] as $val => $arValue): ?>
                                        <input
                                                style="display: none"
                                                type="checkbox"
                                                name="<?= $arValue["CONTROL_NAME"] ?>"
                                                id="<?= $arValue["CONTROL_ID"] ?>"
                                                value="<?= $arValue["HTML_VALUE"] ?>"
											<?= $arValue["CHECKED"] ? 'checked="checked"' : '' ?>
                                        />
										<?
										$class = "";
										if ($arValue["CHECKED"])
											$class .= " bx-active";
										if ($arValue["DISABLED"])
											$class .= " disabled";
										?>
                                        <label for="<?= $arValue["CONTROL_ID"] ?>"
                                               data-role="label_<?= $arValue["CONTROL_ID"] ?>"
                                               class="bx-filter-param-label <?= $class ?>"
                                               onclick="smartFilter.keyup(BX('<?= CUtil::JSEscape($arValue["CONTROL_ID"]) ?>')); BX.toggleClass(this, 'bx-active');">
                                                    <span class="bx-filter-param-btn bx-color-sl">
                                                        <? if (isset($arValue["FILE"]) && !empty($arValue["FILE"]["SRC"])): ?>
                                                            <span class="bx-filter-btn-color-icon"
                                                                  style="background-image:url('<?= $arValue["FILE"]["SRC"] ?>');"></span>
                                                        <? endif ?>
                                                    </span>
                                        </label>
									<? endforeach ?>
                                </div>
							<?
							break;
							case 'H'://CHECKBOXES_WITH_PICTURES_AND_LABELS
							?>
                                <div class="bx-filter-param-btn-block">
									<? foreach ($arItem["VALUES"] as $val => $arValue): ?>
                                        <input
                                                style="display: none"
                                                type="checkbox"
                                                name="<?= $arValue["CONTROL_NAME"] ?>"
                                                id="<?= $arValue["CONTROL_ID"] ?>"
                                                value="<?= $arValue["HTML_VALUE"] ?>"
											<?= $arValue["CHECKED"] ? 'checked="checked"' : '' ?>
                                        />
										<?
										$class = "";
										if ($arValue["CHECKED"])
											$class .= " bx-active";
										if ($arValue["DISABLED"])
											$class .= " disabled";
										?>
                                        <label for="<?= $arValue["CONTROL_ID"] ?>"
                                               data-role="label_<?= $arValue["CONTROL_ID"] ?>"
                                               class="bx-filter-param-label<?= $class ?>"
                                               onclick="smartFilter.keyup(BX('<?= CUtil::JSEscape($arValue["CONTROL_ID"]) ?>')); BX.toggleClass(this, 'bx-active');">
                                                    <span class="bx-filter-param-btn bx-color-sl">
                                                        <? if (isset($arValue["FILE"]) && !empty($arValue["FILE"]["SRC"])): ?>
                                                            <span class="bx-filter-btn-color-icon"
                                                                  style="background-image:url('<?= $arValue["FILE"]["SRC"] ?>');"></span>
                                                        <? endif ?>
                                                    </span>

											<?
											if ($this->arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($arValue["ELEMENT_COUNT"])):
											?> (<span data-role="count_<?= $arValue["CONTROL_ID"] ?>">
                                                <?= $arValue["ELEMENT_COUNT"]; ?>
                                                </span>)<?
											endif; ?></span>
                                        </label>
									<? endforeach ?>
                                </div>
							<?
							break;
							case 'P'://DROPDOWN
							$checkedItemExist = false;
							?>
                                <div class="bx-filter-select-container">
                                    <div class="bx-filter-select-block"
                                         onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>');">
                                        <div class="bx-filter-select-text" data-role="currentOption">
											<?
											foreach ($arItem["VALUES"] as $val => $arValue) {
												if ($arValue["CHECKED"]) {
													echo $arValue["VALUE"];
													$checkedItemExist = true;
												}
											}
											if (!$checkedItemExist) {
												echo GetMessage("CT_BCSF_FILTER_ALL");
											}
											?>
                                        </div>
                                        <div class="bx-filter-select-arrow"></div>
                                        <input
                                                style="display: none"
                                                type="radio"
                                                name="<?= $arValues["CONTROL_NAME_ALT"] ?>"
                                                id="<?= "all_" . $arValues["CONTROL_ID"] ?>"
                                                value=""
                                        />
										<? foreach ($arItem["VALUES"] as $val => $arValue): ?>
                                            <input
                                                    style="display: none"
                                                    type="radio"
                                                    name="<?= $arValue["CONTROL_NAME_ALT"] ?>"
                                                    id="<?= $arValue["CONTROL_ID"] ?>"
                                                    value="<?= $arValue["HTML_VALUE_ALT"] ?>"
												<?= $arValue["CHECKED"] ? 'checked="checked"' : '' ?>
                                            />
										<? endforeach ?>
                                        <div class="bx-filter-select-popup" data-role="dropdownContent"
                                             style="display: none;">
                                            <ul>
                                                <li>
                                                    <label for="<?= "all_" . $arValues["CONTROL_ID"] ?>"
                                                           class="bx-filter-param-label"
                                                           data-role="label_<?= "all_" . $arValues["CONTROL_ID"] ?>"
                                                           onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $arValues["CONTROL_ID"]) ?>');">
														<?= GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                                    </label>
                                                </li>
												<?
												foreach ($arItem["VALUES"] as $val => $arValue):
													$class = "";
													if ($arValue["CHECKED"])
														$class .= " selected";
													if ($arValue["DISABLED"])
														$class .= " disabled";
													?>
                                                    <li>
                                                        <label for="<?= $arValue["CONTROL_ID"] ?>"
                                                               class="bx-filter-param-label<?= $class ?>"
                                                               data-role="label_<?= $arValue["CONTROL_ID"] ?>"
                                                               onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($arValue["CONTROL_ID"]) ?>');"><?= $arValue["VALUE"] ?></label>
                                                    </li>
												<? endforeach ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
							<?
							break;
							case 'R'://DROPDOWN_WITH_PICTURES_AND_LABELS
							?>
                                <div class="bx-filter-select-container">
                                    <div class="bx-filter-select-block"
                                         onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>');">
                                        <div class="bx-filter-select-text fix" data-role="currentOption">
											<?
											$checkedItemExist = false;
											foreach ($arItem["VALUES"] as $val => $arValue):
												if ($arValue["CHECKED"]) {
													?>
													<? if (isset($arValue["FILE"]) && !empty($arValue["FILE"]["SRC"])): ?>
                                                        <span class="bx-filter-btn-color-icon"
                                                              style="background-image:url('<?= $arValue["FILE"]["SRC"] ?>');"></span>
													<? endif ?>
                                                    <span class="bx-filter-param-text"></span>
													<?
													$checkedItemExist = true;
												}
											endforeach;
											if (!$checkedItemExist) {
												?><span class="bx-filter-btn-color-icon all"></span> <?
												echo GetMessage("CT_BCSF_FILTER_ALL");
											}
											?>
                                        </div>
                                        <div class="bx-filter-select-arrow"></div>
                                        <input
                                                style="display: none"
                                                type="radio"
                                                name="<?= $arValues["CONTROL_NAME_ALT"] ?>"
                                                id="<?= "all_" . $arValues["CONTROL_ID"] ?>"
                                                value=""
                                        />
										<? foreach ($arItem["VALUES"] as $val => $arValue): ?>
                                            <input
                                                    style="display: none"
                                                    type="radio"
                                                    name="<?= $arValue["CONTROL_NAME_ALT"] ?>"
                                                    id="<?= $arValue["CONTROL_ID"] ?>"
                                                    value="<?= $arValue["HTML_VALUE_ALT"] ?>"
												<?= $arValue["CHECKED"] ? 'checked="checked"' : '' ?>
                                            />
										<? endforeach ?>
                                        <div class="bx-filter-select-popup" data-role="dropdownContent"
                                             style="display: none">
                                            <ul>
                                                <li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
                                                    <label for="<?= "all_" . $arValues["CONTROL_ID"] ?>"
                                                           class="bx-filter-param-label"
                                                           data-role="label_<?= "all_" . $arValues["CONTROL_ID"] ?>"
                                                           onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $arValues["CONTROL_ID"]) ?>');">
                                                        <span class="bx-filter-btn-color-icon all"></span>
														<?= GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                                    </label>
                                                </li>
												<?
												foreach ($arItem["VALUES"] as $val => $arValue):
													$class = "";
													if ($arValue["CHECKED"])
														$class .= " selected";
													if ($arValue["DISABLED"])
														$class .= " disabled";
													?>
                                                    <li>
                                                        <label for="<?= $arValue["CONTROL_ID"] ?>"
                                                               data-role="label_<?= $arValue["CONTROL_ID"] ?>"
                                                               class="bx-filter-param-label<?= $class ?>"
                                                               onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($arValue["CONTROL_ID"]) ?>');">
															<? if (isset($arValue["FILE"]) && !empty($arValue["FILE"]["SRC"])): ?>
                                                                <span class="bx-filter-btn-color-icon"
                                                                      style="background-image:url('<?= $arValue["FILE"]["SRC"] ?>');"></span>
															<? endif ?>
                                                            <span class="bx-filter-param-text"></span>
                                                        </label>
                                                    </li>
												<? endforeach ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
							<?
							break;
							case 'K'://RADIO_BUTTONS
							?>
                                <div class="radio">
                                    <label class="bx-filter-param-label"
                                           for="<?= "all_" . $arValues["CONTROL_ID"] ?>">
                                                    <span class="bx-filter-input-checkbox">
                                                        <input
                                                                type="radio"
                                                                value=""
                                                                name="<?= $arValues["CONTROL_NAME_ALT"] ?>"
                                                                id="<?= "all_" . $arValues["CONTROL_ID"] ?>"
                                                                onclick="smartFilter.click(this);"
                                                        />
                                                        <span class="bx-filter-param-text"><?= GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
                                                    </span>
                                    </label>
                                </div>
								<?

							foreach ($arItem["VALUES"] as $val => $arValue): ?>
                                <div class="radio">
                                    <label data-role="label_<?= $arValue["CONTROL_ID"] ?>" class="bx-filter-param-label"
                                           for="<?= $arValue["CONTROL_ID"] ?>">
                                                        <span class="bx-filter-input-checkbox <?= $arValue["DISABLED"] ? 'disabled' : '' ?>">
                                                            <input
                                                                    type="radio"
                                                                    value="<?= $arValue["HTML_VALUE_ALT"] ?>"
                                                                    name="<?= $arValue["CONTROL_NAME_ALT"] ?>"
                                                                    id="<?= $arValue["CONTROL_ID"] ?>"
	                                                            <?= $arValue["CHECKED"] ? 'checked="checked"' : '' ?>
                                                                    onclick="smartFilter.click(this);"
                                                            />

                                                            <span class="bx-filter-param-text"
                                                                  title="<?= $arValue["VALUE"]; ?>">
                                                                <? if ($this->arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($arValue["ELEMENT_COUNT"])):
	                                                                ?> (<span
                                                                        data-role="count_<?= $arValue["CONTROL_ID"] ?>"></span>)<?
                                                                endif; ?></span>
                                                        </span>
                                    </label>
                                </div>
							<?endforeach;
							?>
							<?
							break;
							case 'U'://CALENDAR
							?>
                                <div class="bx-filter-parameters-box-container-block">
                                    <div class="bx-filter-input-container bx-filter-calendar-container">
										<? $APPLICATION->IncludeComponent('bitrix:main.calendar', '', array('FORM_NAME' => $arResult["FILTER_NAME"] . "_form", 'SHOW_INPUT' => 'Y', 'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="' . FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]) . '" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"', 'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"], 'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"], 'SHOW_TIME' => 'N', 'HIDE_TIMEBAR' => 'Y',), null, array('HIDE_ICONS' => 'Y')); ?>
                                    </div>
                                </div>
                                <div class="bx-filter-parameters-box-container-block">
                                    <div class="bx-filter-input-container bx-filter-calendar-container">
										<? $APPLICATION->IncludeComponent('bitrix:main.calendar', '', array('FORM_NAME' => $arResult["FILTER_NAME"] . "_form", 'SHOW_INPUT' => 'Y', 'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="' . FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]) . '" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"', 'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"], 'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"], 'SHOW_TIME' => 'N', 'HIDE_TIMEBAR' => 'Y',), null, array('HIDE_ICONS' => 'Y')); ?>
                                    </div>
                                </div>
							<?
							break;
							default://CHECKBOXES

							foreach ($arItem["VALUES"] as $val => $arValue) {

							if ($arValue["VALUE"] == 'пусто')
								continue;

							if (empty($arValue["VALUE"])) {
								switch ($val) {
									case 'Y':
										$arValue["VALUE"] = 'Есть';
										break;

									case 'N':
										$arValue["VALUE"] = 'Нет';
										break;
								}
							}

							switch ($arValue["VALUE"]) {
								case 'Y':
									$arValue["VALUE"] = 'Есть';
									break;

								case 'N':
									$arValue["VALUE"] = 'Нет';
									break;
							}
							?>

                                <div class="checkbox">
                                    <input
                                            type="checkbox"
                                            value="<?= $arValue["HTML_VALUE"] ?>"
                                            name="<?= $arValue["CONTROL_NAME"] ?>"
                                            id="<?= $arValue["CONTROL_ID"] ?>"
										<?= $arValue["CHECKED"] ? 'checked="checked"' : '' ?>
                                            onclick="smartFilter.click(this);"
                                    />

                                    <label data-role="label_<?= $arValue["CONTROL_ID"] ?>"
                                           class="bx-filter-param-label <?= $arValue["DISABLED"] ? 'disabled' : '' ?>"
                                           for="<?= $arValue["CONTROL_ID"] ?>">
										<?= $arValue["VALUE"]; ?>
                                    </label>
                                </div>
							<? }
							}
							?>
                        </div>
                        <div style="clear: both"></div>
                    </div>
					<?
				} ?>
            </div>
        </div>
		<?
	}

	/**
	 * @param $code
	 *
	 * @return mixed
	 */
	public function getIdByCode($code)
	{
		return $this->component->arResult['CODE_TO_ID'][$code];
	}

	public function getCodeById($id)
	{
		return $this->component->arResult['ITEMS'][$id]['CODE'];
	}

	private function getNameBlock($arItem, $data = null)
	{
		?>
        <span class="bx-filter-container-modef"></span>

		<? $hintExist = $arItem["FILTER_HINT"] <> ""; ?>
        <div class="bx-filter-parameters-box-title <?= $hintExist ? 'with-q' : '' ?>"
             onclick="smartFilter.hideFilterProps(this);" data-type="<?= $data ?>">

            <div class="bx-filter-parameters-box-hint"><?= $arItem["NAME"] ?></div>
			<? if ($hintExist) { ?>
                <i id="item_title_hint_<?= $arItem["ID"] ?>" class="fa fa-question"></i>

                <script type="text/javascript">
					new top.BX.CHint({
						parent:       top.BX("item_title_hint_<?= $arItem["ID"]?>'),
						show_timeout: 10,
						hide_timeout: 200,
						dx:           2,
						preventHide:  true,
						min_width:    250,
						hint:         '<?= CUtil::JSEscape($arItem["FILTER_HINT"])?>'
					});
                </script>
			<? } ?>
        </div>
		<?
	}

	/**
	 * @param $arItem
	 *
	 * @return mixed
	 * @internal param $params
	 *
	 */
	private function checkParams($arItem)
	{
		$params = array();
		// Для попарного вывода некоторых свойств
		switch ($arItem['CODE']) {
			case 'OUT_MIN_CONNECTION_BLOCK':
				$params['second'] = 'OUT_MAX_CONNECTION_BLOCK';
				$params['title'] = 'Количество подключаемых внутренних блоков';
				break;

			case 'OUT_MIN_TEMP_COOLING':
				$params['second'] = 'OUT_MAX_TEMP_COOLING';
				$params['title'] = 'Допустимая температура наружного блока (охлаждение)';
				break;

			case 'OUT_MIN_TEMP_HEATED':
				$params['second'] = 'OUT_MAX_TEMP_HEATED';
				$params['title'] = 'Допустимая температура наружного блока (нагрев)';
				break;

			case 'IND_MIN_NOISE':
				$params['second'] = 'IND_MAX_NOISE';
				$params['title'] = 'Уровень шума внутреннего блока';
				break;

			case 'OUT_MIN_NOISE':
				$params['second'] = 'OUT_MAX_NOISE';
				$params['title'] = 'Уровень шума внешнего блока';
				break;

			// Для вывода одного чекбокса (блок "функции")
			case 'FNC_MOTION_SENSOR':
			case 'FNC_SELFDIAGNOS':
			case 'FNC_SELF_CLEANING_FILTERS':
			case 'FNC_FLOW_DIRECTION':
			case 'FNC_SPEED_CONTROLLER':
			case 'FNC_NIGHT_MODE':
			case 'FNC_DEHUMIDIFIC_MODE':
			case 'FNC_FRESHAIR':
			case 'FNC_ION_AIR':
			case 'FNC_TIMER_ON_OFF':
			case 'FNC_AUTO_REST':
				$params['type'] = 'singleCheckbox';
				break;

			// Тут собираются 'second'-коды
			// todo: придумать автоматизацию
			case 'OUT_MAX_CONNECTION_BLOCK':
			case 'OUT_MAX_TEMP_COOLING':
			case 'OUT_MAX_TEMP_HEATED':
			case 'IND_MAX_NOISE':
			case 'OUT_MAX_NOISE':
				$params['skip'] = true;
				break;

			default:
				break;
		}

		return $params;
	}
}
