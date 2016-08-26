                        <div class="tile bg-red">
                            <div class="column-left">
                                <i class="wi wi-thermometer"></i>
                            </div>
                            <div class="column-right">
                                <h5><?= $dashboard->temp1; ?></h5>
                                <h2>
                                <?php if (isset($dashboard->data['temp1'])): echo $dashboard->data['signs']['temp1'] . $dashboard->data['temp1'] ?><i class="wi wi-celsius"></i>
                                <?php else: ?><i class="wi wi-na"></i>
                                <?php endif; ?>
                                </h2>
                            </div>
                        </div>