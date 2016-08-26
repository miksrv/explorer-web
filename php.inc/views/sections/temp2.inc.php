                        <div class="tile bg-red">
                            <div class="column-left">
                                <i class="wi wi-thermometer-exterior"></i>
                            </div>
                            <div class="column-right">
                                <h5><?= $dashboard->temp2; ?></h5>
                                <h2>
                                <?php if (isset($dashboard->data['temp2'])): echo $dashboard->data['signs']['temp2'] . $dashboard->data['temp2'] ?><i class="wi wi-celsius"></i>
                                <?php else: ?><i class="wi wi-na"></i>
                                <?php endif; ?>
                                </h2>
                            </div>
                        </div>