                        <div class="tile bg-brown">
                            <div class="column-left">
                                <i class="fa fa-battery-full"></i>
                            </div>
                            <div class="column-right">
                                <h5><?= $dashboard->battery; ?></h5>
                                <h2>
                                <?php if (isset($dashboard->data['battery'])): echo $dashboard->data['signs']['battery'] . $dashboard->data['battery'] ?>V
                                <?php else: ?><i class="wi wi-na"></i>
                                <?php endif; ?>
                                </h2>
                            </div>
                        </div>