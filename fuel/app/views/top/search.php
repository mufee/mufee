<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class='col-md-12 margin-top-2 mufee-superblock'>
                <div class='row'>
                    <aside class="create-comment" id="create-comment">
                        <h2>
                            <i class="icon-search"></i> Artist Search
                        </h2>
                        <?php if (!empty($answer)): ?>
                            <form action='artist/view' method='post'>
                                <h2>
                                    <?php echo $searchstr . '>'; ?>
                                    <input type="hidden" name="artistid" value="<?php echo $answer[0]; ?>">もしかして：<button class="linkstyle"><?php echo $answer[1]; ?></button>？
                                </h2>
                            </form>
                            <div class='col-lg-12 col-lg-offset-3'>
                                <a href="/artist/view?id=<?php echo $answer[0]; ?>" target='_brank'>
                                    <img class='img-polaroid' alt="" src="/uploadthumbnail/<?php echo $answer[2] ?>" class="search-thumbnail-ans "/>
                                </a>
                            </div>
                            <h2>
                                それとも？
                            </h2>
                            <div class='col-md-10 col-lg-offset-1'>
                                <table class="table table-striped">
                                    <?php if (!empty($namelist[0])): ?>
                                        <?php foreach ($namelist as $val): ?>
                                            <tr>
                                                <th><h1>
                                                <form action='artist/view' method='post'>
                                                    <input type="hidden" name="artistid" value="<?php echo $val[0]; ?>">
                                                    <button class="linkstyle"><?php echo $val[1]; ?></button>
                                                </form>
                                            </h1></th>
                                            <td>
                                                <img alt="" src="/uploadthumbnail/<?php echo $val[2] ?>" class="search-thumbnail"/>
                                            </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </table>
                            </div>
                        <?php else: ?>
                            <h2>
                                関連するアーティストは見つかりませんでした。
                            </h2>
s                        <?php endif; ?>

                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>