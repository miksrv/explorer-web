                        <div class="tile bg-green">
                            <div class="column-left">
                                <i class="wi wi-day-sunny"></i>
                            </div>
                            <div class="column-right">
                                <h5><?= $dashboard->light; ?></h5>
                                <h2>
                                <?php if (isset($dashboard->data['light'])): echo $dashboard->data['signs']['light'] . $dashboard->data['light'] ?>
                                <?php else: ?><i class="wi wi-na"></i>
                                <?php endif; ?>
                                </h2>
                            </div>
                        </div>