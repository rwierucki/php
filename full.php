<style>
    body {
        background: white;
        font-size: 10px;
    }

    .row {
        margin-bottom: 0px;
    }

    .page-header {
        padding: 0 10px;
        margin: 10px 0 10px;
        border: 1px solid #eeeeee;
    }

    .page-header h5 {
        font-size: 15px;
    }

    .bordered {
        padding-top: 10px;
        padding-bottom: 10px;

        border: 1px solid #eeeeee;
    }

</style>

<?php

function issetRow($row)
{
    foreach ($row as $r) {
        if (isset($r->value) || isset($r->manufacturer))
            return true;
    }
    return false;
}

?>

<div class="container">
    <div class="row hidden-print">
        <div class="col-md-3">
            <?php
            if (isset($_GET['admin'])) { ?>
                <a class="btn btn-block" href="/<?= BASE_PATH ?>/home/index/diag#latest-vehicles">Wróć</a>
            <?php } else { ?>
                <!--a class="btn btn-block" href="<?= '/' . BASE_PATH ?>">Wróć</a-->
            <?php } ?>
        </div>

        <div class="col-md-3 col-md-offset-6">
            <a class="btn btn-block" onclick="window.print();">Wydrukuj</a>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-2">
            <br/><br/><br/>
            <img src="http://www.tts-strykow.pl/media/images/logo.jpg" class="img-responsive"/>
        </div>
        <div class="col-xs-4">
            <br/><br/>
            <h5>Protokół Przyjęcia Pojazdu</h5>
        </div>

        <div class="col-xs-6" style="font-size: 8px;">
            <br/><br/><br/>
            Truck & Trailer Store Polska Sp. z o. o. <br/>
            Smolice 1L - Tulipan Park, 95-010 Stryków, Polska,<br/>
            Tel.: +48 42 280 25 77, Fax: +48 42 280 25 02<br/>
            Sąd Rejonowy dla Łodzi-Śródmieścia w Łodzi, XX Wydział Krajowego Rejestru Sądowego<br/>
            Numer KRS: 0000424558; Kapitał zakładowy 400.000 zł, NIP 733-13-47-244; REGON 101430283<br/>
        </div>

    </div>

    <br/><br/>

    <?php
    if (isset($vehicle->info) && issetRow($vehicle->info)) {
        ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h5 class="page-title">Dokumenty</h5>
                </div>
            </div>

            <?php
            $isCoolerYearCorrect = true;
            foreach ($vehicle->info as $key => $record) {

                if ($key == "datetime" || $key == "vehicletype") {

                    continue;
                }
                if (isset($record->value) && $record->value != "") { ?>
                    <div class="col-xs-6">
                        <div class="row">
                            <div class="col-xs-6">
                                <b><?= Model_VehicleLabel::translate($key); ?></b>
                            </div>
                            <div class="col-xs-6">
                                <?= strtoupper($record->value); ?>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
        <?php
    }
    ?>

    <?php
    if (isset($vehicle->front) && issetRow($vehicle->front)) {
        ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h5 class="page-title">Przód pojazdu</h5>
                </div>
            </div>

            <?php if (isset($vehicle->front)) {
                foreach ($vehicle->front as $key => $record) {
                    if (isset($record->value) && $record->value != "") { ?>
                        <div class="col-xs-6">
                            <div class="row">
                                <div class="col-xs-6">
                                    <b><?= Model_VehicleLabel::translate($key); ?></b>
                                </div>
                                <div class="col-xs-6">
                                    <?php if ($record->value == "1" || $record->value == "0") { ?>
                                        <?= ($record->value) ? "TAK" : "NIE"; ?>
                                    <?php } else { ?>
                                        <?= strtoupper($record->value); ?>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    <?php }
                }
            } ?>
        </div>
        <?php
    }
    ?>

    <?php

    if (isset($vehicle->chiller) && issetRow($vehicle->chiller)) {

        ?>
        <div class="row">
            <?php if (isset($vehicle->chiller)) { ?>
                <div class="col-xs-12">
                    <div class="page-header">
                        <h5 class="page-title">Agregat chłodniczy</h5>
                    </div>
                </div>
                <?php
                $prodyear = isset($vehicle->info->production_year) ? $vehicle->info->production_year : 0;
                $prodyearcooler = isset($vehicle->chiller->production_year_cooler) ? $vehicle->chiller->production_year_cooler : 0;
                $isCoolerYearCorrect = $prodyearcooler == (isset($prodyear->value) ? $prodyear->value : $prodyear);
                foreach ($vehicle->chiller as $key => $record) {
                    if (isset($record->value) && $record->value != "" && $record->value != "brak") { ?>
                        <div class="col-xs-6">
                            <div class="row">
                                <div class="col-xs-6">
                                    <b><?= Model_VehicleLabel::translate($key); ?></b>
                                </div>
                                <div class="col-xs-6">
                                    <?php if ($record->value == "1" || $record->value == "0") { ?>
                                        <?= ($record->value) ? "TAK" : "NIE"; ?>
                                    <?php } else { ?>
                                        <?= strtoupper($record->value); ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }

                if (!$isCoolerYearCorrect) {
                    ?>
                    <div class="col-xs-6">
                        <div class="row">
                            <div class="col-xs-6">
                                <b>Uwagi</b>
                            </div>
                            <div class="col-xs-6">
                                <b>Różne roczniki agregatu i naczepy!</b>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
        <?php
    }
    ?>

    <?php
    if (isset($vehicle->building) && issetRow($vehicle->building)) {
        ?>
        <div class="row">
            <?php if (isset($vehicle->building)) { ?>
                <div class="col-xs-12">
                    <div class="page-header">
                        <h5 class="page-title">Zabudowa</h5>
                    </div>
                </div>

                <?php foreach ($vehicle->building as $key => $record) {
                    if (isset($record->value) && $record->value != "" && $record->value != "brak") { ?>
                        <div class="col-xs-6">
                            <div class="row">
                                <div class="col-xs-6">
                                    <b><?= Model_VehicleLabel::translate($key); ?></b>
                                </div>
                                <div class="col-xs-6">
                                    <?php if ($record->value == "1" || $record->value == "0") { ?>
                                        <?= ($record->value) ? "TAK" : "NIE"; ?>
                                    <?php } else { ?>
                                        <?= strtoupper($record->value); ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
            } ?>
        </div>
        <?php
    }
    ?>

    <?php if (isset($vehicle->interior) && issetRow($vehicle->interior)) { ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h5 class="page-title">Środek pojazdu</h5>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-4">
                        <b>Wymiary - długość</b>
                        <p><?php strtoupper(@$vehicle->interior->dimensions->length); ?> mm </p>
                    </div>
                    <div class="col-xs-4">
                        <b>Wymiary - szerokość</b>
                        <p><?php strtoupper(@$vehicle->interior->dimensions->width); ?> mm </p>
                    </div>
                    <div class="col-xs-4">
                        <b>Wymiary - wysokość</b>
                        <p><?php strtoupper(@$vehicle->interior->dimensions->height); ?> mm </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12"><b>DOST</b></div>
                    <div class="col-xs-6">
                        <div class="row">
                            <div class="col-xs-6"><b>Stan</b></div>
                            <div class="col-xs-6">
                               <?php echo @$vehicle->building->second_floor_beams->status; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="row">
                            <div class="col-xs-6"><b>Ilość belek</b></div>
                            <div class="col-xs-6">
                                <?php echo @$vehicle->building->second_floor_beams->type; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>

    <?php if (isset($vehicle->additional_equipment) && issetRow($vehicle->additional_equipment)) { ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h5 class="page-title">Tył pojazdu</h5>
                </div>
            </div>
            <?php if (isset($vehicle->additional_equipment)) {
                foreach ($vehicle->additional_equipment as $key => $record) {
                    if (isset($record->value) && $record->value != "" && $record->value != "brak") { ?>
                        <div class="col-xs-6">
                            <div class="row">
                                <div class="col-xs-6">
                                    <b><?= Model_VehicleLabel::translate($key); ?></b>
                                </div>
                                <div class="col-xs-6">
                                    <?php if ($record->value == "1" || $record->value == "0") { ?>
                                        <?= ($record->value) ? "TAK" : "NIE"; ?>
                                    <?php } else { ?>
                                        <?= strtoupper($record->value); ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
            } ?>
        </div>
    <?php } ?>

    <?php if (isset($vehicle->loading_platform) && issetRow($vehicle->loading_platform) && $vehicle->loading_platform->manufacturer->value != "brak") { ?>
        <div class="row">
            <?php if (isset($vehicle->loading_platform)) { ?>

                <div class="col-xs-12">
                    <div class="page-header">
                        <h5 class="page-title">Winda</h5>
                    </div>
                </div>
                <?php foreach ($vehicle->loading_platform as $key => $record) {
                    if (isset($record->value) && $record->value != "" && $record->value != "brak") { ?>
                        <div class="col-xs-6">
                            <div class="row">
                                <div class="col-xs-6">
                                    <b><?= Model_VehicleLabel::translate($key); ?></b>
                                </div>
                                <div class="col-xs-6">
                                    <?php if ($record->value == "1" || $record->value == "0") { ?>
                                        <?= ($record->value) ? "TAK" : "NIE"; ?>
                                    <?php } else { ?>
                                        <?= strtoupper($record->value); ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
            } ?>
        </div>

    <?php } ?>

    <?php if (isset($vehicle->tires) && $vehicle->tires) { ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h5 class="page-title">Opony</h5>
                </div>
            </div>

            <div class="row" style="margin:0;">
                <?php if (isset($vehicle->tires)) {
                    function cmp($a, $b)
                    {
                        return strcmp($a, $b);
                    }

                    $array = (array)$vehicle->tires;
                    ksort($array);

                    $i = 0;
                    foreach ($array as $key => $record) {
                        $i++;
                        if (isset($record->manufacturer)) { ?>
                            <div class="col-xs-6">
                                <div class="col-xs-12 bordered">
                                    <b><?= Model_VehicleLabel::translate($key); ?></b>

                                    <div class="row">
                                        <?php foreach ($record as $key2 => $parameter) {
                                            if ($key2 == "image") continue; ?>
                                            <div class="col-xs-6">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <b><?= Model_VehicleLabel::translate($key2); ?></b>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <?= strtoupper($parameter); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if ($i % 2 == 0) {
                                echo '</div><div class="row" style="margin:0;">';
                            }
                        }
                    }
                } ?>
            </div>
        </div>
    <?php } ?>

    <?php if (isset($vehicle->brakes) && issetRow($vehicle->brakes)) { ?>
        <div class="row">
            <?php if (isset($vehicle->brakes)) { ?>
                <div class="col-xs-12">
                    <div class="page-header">
                        <h5 class="page-title">Hamulce</h5>
                    </div>
                </div>

                <?php foreach ($vehicle->brakes as $key => $record) {
                    if (isset($record->value)) { ?>
                        <div class="col-xs-6">
                            <div class="row">
                                <div class="col-xs-6">
                                    <b><?= Model_VehicleLabel::translate($key); ?></b>
                                </div>
                                <div class="col-xs-6">
                                    <?php if ($record->value == "1" || $record->value == "0") { ?>
                                        <?= ($record->value) ? "TAK" : "NIE"; ?>
                                    <?php } else { ?>
                                        <?= strtoupper($record->value); ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php if ($key == 'brakes_type') { ?>
                            <div class="col-xs-12">
                                <hr/>
                            </div>
                        <?php }
                    }
                }
            } ?>
        </div>
    <?php } ?>
    <?php if (isset($vehicle->tilt))  { ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h5 class="page-title">Plandeka</h5>
            </div>
        </div>
        <?php foreach ($vehicle->tilt as $key => $record) {
            if (isset($record->value)) { ?>
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-6">
                            <b><?= Model_VehicleLabel::translate($key); ?></b>
                        </div>
                        <div class="col-xs-6">
                            <?php if ($record->value == "1" || $record->value == "0") { ?>
                               <?= ($record->value) ? "TAK" : "NIE"; ?>
                            <?php } else { ?>
                               <?= strtoupper($record->value); ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php if ($key == 'brakes_type') { ?>
                    <div class="col-xs-12">
                        <hr/>
                    </div>
                <?php }
            }

        } ?>





    </div>
    <?php } ?>
    <div class="row">

        <div class="col-xs-12">
            <div class="page-header">
                <h5 class="page-title">Zdjęcia</h5>
            </div>
        </div>
        <?php

        foreach ($vehicle as $draft_category_name => $draft_category) {
            if ($draft_category_name !== "unassigned") {
                foreach ($draft_category as $key => $value) {
                    foreach ($value as $key2 => $value2) {
                        if ($value2 !== "" && $key2 == "image") {
                            $path = null;
                            if (strpos($value2, '/images/')) {
                                $path = $value2;
                            } else {
                                $path = 'data:image/png;base64,' . $value2;
                            }
                            $images[] = array(
                                'path' => $path,
                                'name' => Model_VehicleLabel::translate($key)
                            );
                        }
                    }
                }
            }
        }

        if (!empty($images)) {
            $i = 1;
            foreach ($images as $key => $image) {
                $i++;
                if ($image['name'] == "Podpis pracownika") {
                    $signature = $image;
                    unset($images[$key]);
                }
            }
            $i = 1;
            foreach ($images as $key => $image) {
                $i++; ?>
                <div class="col-xs-4">
                    <img src="<?= $image['path']; ?>" style="width: 100%;">
                    <br/><br/>
                    <p><?= $image['name']; ?></p>

                    <hr/>
                </div>

                <?php
                $key++;
                if ($key % 3 == 0) { ?>
                    <div class="col-xs-12"></div>
                <?php }

                if ($i == 10) { ?>
                    <hr/>
                    <?php $i = 1;
                }
            }
        } ?>
    </div>

    <div class="col-xs-4 col-xs-offset-8">
        <img src="<?= @$signature['path']; ?>" style="width: 100%;">
        <br/><br/>
        <b>
            <?php
            echo @$vehicle->report->reporter_name->value . ' ' . @$vehicle->info->catch_date->value;
            ?>
        </b>
    </div>
    <?php
    $vehicle_repororter_comments = '';
    @$vehicle_repororter_comments = trim($vehicle->report->reporter_name->comments);
    if (!empty($vehicle_repororter_comments)) { ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h5 class="page-title">Inne uwagi do wyceny</h5>

            </div>
        </div>
        <div class="col-xs-12">
            <div class="col-xs-8">
                <p><?php echo @$vehicle_repororter_comments; ?></p>
            </div>
        </div>
    </div>

    <?php } ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h5 class="page-title">Uszkodzenia do naprawy</h5>
            </div>
        </div>
        <?php
        $i = 0;

        $baseArray = [];
        $results = DB::select('price')->from('faults')->where('index', '=', $draftId)->execute();
        if (isset($results)) {
            foreach ($results as $price) {
                $baseArray = json_decode($price['price'], true);
            }
        }


        if (isset($baseArray['price'])) {
            $baseArrayPrice = $baseArray['price'];
        }
        if (isset($baseArray['name'])) {
            $baseArrayName = $baseArray['name'];
        }

        $sumprice = 0;
        $sumToDo = false;
        foreach ($vehicle as $group) {
            foreach ($group as $key => $element) {
                if ($key === 'reporter_name') {
                    continue;
                }
                if (isset($element->comments) && $element->comments != "") {
                    if (isset($baseArrayName) && isset($baseArrayPrice)) {
                        $thePrice = array_search($key, $baseArrayName);
                    } else {
                        $baseArrayPrice[0] = 0;
                        $thePrice = 0;
                    }
                    ?>
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-1 text-center">
                                <br/>
                                <?= $i++; ?>
                            </div>
                            <div class="col-xs-8">
                                <b><?= Model_VehicleLabel::translate($key); ?></b>
                                <p><?= $element->comments; ?></p>

                            </div>
                            <div class="col-xs-3">
                                Wycena: <br/>
                                <?php


                                if (!is_numeric($baseArrayPrice[$thePrice])) {
                                    echo 'DO WYCENY';
                                    $sumToDo = true;
                                } else {
                                    echo $baseArrayPrice[$thePrice] . ' PLN';
                                }
                                $sumprice = $sumprice + $baseArrayPrice[$thePrice]; ?>
                            </div>

                        </div>
                        <hr/>
                    </div>
                <?php }
            }
        } ?>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-1 text-center">
                    <br/>
                    -
                </div>
                <div class="col-xs-8">
                    <b>Podsumowanie</b>
                    <p>Suma wszystkich napraw</p>
                </div>
                <div class="col-xs-3">
                    Razem: <br/>
                    <?= $sumprice; ?> PLN
                    </br> <?php if ($sumToDo) {
                        echo "(wycena nie została ukończona)";
                    } ?>
                </div>
            </div>
            <hr/>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-6 text-center">
                    <span>W imieniu Korzystającego potwierdzam stan techniczny pojazdu, który został opisany w niniejszym protokole.</span>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <span>____________________________________________________________</span>
                    <br/>
                    <br/>
                    <span>Data i czytelny podpis – za Korzystającego</span>

                </div>
                <div class="col-xs-6 text-center">
                    <span>W imieniu Przyjmującego potwierdzam stan techniczny pojazdu, który został opisany w niniejszym protokole.</span>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <span>____________________________________________________________</span>
                    <br/>
                    <br/>
                    <span>Data i czytelny podpis – za Przyjmującego</span>
                </div>
            </div>
            <hr/>
        </div>
    </div>
</div>

