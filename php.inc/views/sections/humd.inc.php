                        <div class="tile bg-blue">
                            <div class="column-left">
                                <i class="wi wi-humidity"></i>
                            </div>
                            <div class="column-right">
                                <h5><?= $dashboard->humd; ?></h5>
                                <h2>
                                <?php if (isset($dashboard->data['humd'])): echo $dashboard->data['signs']['humd'] . $dashboard->data['humd'] ?> %
                                <?php else: ?><i class="wi wi-na"></i>
                                <?php endif; ?>
                                </h2>
                            </div>
                        </div>