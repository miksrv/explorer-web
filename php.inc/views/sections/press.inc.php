                        <div class="tile bg-cobalt">
                            <div class="column-left">
                                <i class="wi wi-barometer"></i>
                            </div>
                            <div class="column-right">
                                <h5><?= $dashboard->press; ?></h5>
                                <h2>
                                <?php if (isset($dashboard->data['press'])): echo $dashboard->data['signs']['press'] . $dashboard->data['press'] ?>
                                <?php else: ?><i class="wi wi-na"></i>
                                <?php endif; ?>
                                </h2>
                            </div>
                        </div>