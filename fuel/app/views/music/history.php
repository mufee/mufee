<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class='col-md-12 mufee-superblock'>
                <aside class="comments" id="comments">
                    <h2>
                        <i class="icon-book"></i> Music History
                    </h2>
                    <div class='col-md-10 col-md-offset-1 margin-bottom-3'>
                        <?php for ($i = 0; $i < count($histdata); $i++): ?>
                        <article class="comment">
                            <?php if ($i % 2 == 0): ?>
                                <header class="clearfix">
                            <?php else: ?>
                                <header class="clearfix reply">
                            <?php endif; ?>
                                    <img src="/uploadthumbnail/<?php echo $histdata[$i]['thumbnailname'] ?>" alt="A Smart Guy" class="avatar">
                                    <div class="meta history">
                                        <h3>
                                            <a href="/artist/view?id=<?php echo $histdata[$i]['artistid'] ?>"><?php echo $histdata[$i]['username'] ?></a>
                                        </h3>
                                        <span class="date"><?php echo $histdata[$i]['title'] ?></span> <span
                                            class="separator"> - </span> <a href="/artist/view?id=<?php echo $histdata[$i]['artistid'] ?>"
                                            class="reply-link">More</a>
                                    </div>
                                </header>
                        </article>
                    <?php endfor; ?>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>