<?php
include 'admin/db_connect.php';
?>



<style>

    .card-custom {
        transition: transform 0.3s, box-shadow 0.3s;

    }

    .card-custom:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(255, 255, 255);
        background-color: white;
        font-color: black;
    }

    .card-custom img {
        transition: transform 0.3s;
    }

    .card-custom:hover img {
        transform: scale(1.1);
    }

    #portfolio .img-fluid {
        width: calc(100%);
        height: 30vh;
        z-index: -1;
        position: relative;
        padding: 1em;
    }


    .event-list {
        cursor: pointer;
    }

    span.hightlight {
        background: yellow;
    }

    .banner {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 26vh;
        width: calc(30%);
    }

    .banner img {
        width: calc(100%);
        height: calc(100%);
        cursor: pointer;
    }

    .event-list {
        cursor: pointer;
        border: unset;
        flex-direction: inherit;
    }

    .event-list .banner {
        width: calc(40%)
    }

    .event-list .card-body {
        width: calc(60%)
    }

    .event-list .banner img {
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
        min-height: 50vh;
    }

    span.hightlight {
        background: yellow;
    }

    .banner {
        min-height: calc(100%)
    }
</style>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <div class="text-center">
                    <img src="assets/img/ambo_LOGO.png" alt="Logo" class="img-fluid mx-auto d-block"
                        style="max-width: 350px; max-height: 180px; margin: 4px;">
                </div>
                <h4 class="text-white" style="font-size: 30px;">Welcome to Ambo University Alumni Service Platform</h4>

                <hr class="mx-auto divider my-4" />

                <div class="col-md-12 mb-2 justify-content-center">
                </div>
            </div>

        </div>
    </div>
</header>
<div class="container mt-3 pt-2">
    <h4 class="text-center text-white mb-4">Upcoming Events</h4>
    <hr class="divider mx-auto mb-4">
    <?php
    $event = $conn->query("SELECT * FROM events where date_format(schedule,'%Y-%m%-d') >= '" . date('Y-m-d') . "' order by unix_timestamp(schedule) asc");
    while ($row = $event->fetch_assoc()):
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['content']), $trans);
        $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
        ?>
        <div data-aos="fade-up" class="card-custom card event-list bg-black" data-id="<?php echo $row['id'] ?>">
            <div class='banner'>
                <?php if (!empty($row['banner'])): ?>
                    <img src="admin/assets/uploads/<?php echo ($row['banner']) ?>" alt="">
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="row align-items-center justify-content-center text-center h-100">
                    <div class="">
                        <h3 class="mb-2 text-white"><b class="filter-txt"><?php echo ucwords($row['title']) ?></b></h3>
                        <div class="mb-2"><small>
                                <p class="text-white"><b><i class="fa fa-calendar"></i>
                                        <?php echo date("F d, Y h:i A", strtotime($row['schedule'])) ?></b></p>
                            </small></div>
                        <hr>
                        <larger class=" text-white truncate filter-txt"><?php echo strip_tags($desc) ?></larger>
                        <br>
                        <hr class="divider mb-2" style="max-width: calc(100%)">
                        
                    </div>
                </div>


            </div>
        </div>
        <br>
    <?php endwhile; ?>

</div>

<div class="container mt-3 pt-2">
    <h4 class="text-center text-white">Campuses</h4>
    <hr class="divider mx-auto">
</div>
<div data-aos="fade-right" class="swiper-container mt-3 pt-2">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="assets/img/hhc.png" style="width: 100%; height: 400px;" alt="Hachalu Hundessa Campus">
        </div>
        <div class="swiper-slide">
            <img src="assets/img/main.jpg" style="width: 100%; height: 400px;" alt="Main Campus">
        </div>
        <div class="swiper-slide">
            <img src="assets/img/woliso.png" style="width: 100%; height: 400px;" alt="Woliso Campus">
        </div>
        <div class="swiper-slide">
            <img src="assets/img/guder.jpg" style="width: 100%; height: 400px; left:10%;" alt="Guder Campus">
        </div>
        <!-- more slides here -->
    </div>
</div>


<script>
    $('.read_more').click(function () {
        location.href = "index.php?page=view_event&id=" + $(this).attr('data-id')
    })
    $('.banner img').click(function () {
        viewer_modal($(this).attr('src'))
    })
    $('#filter').keyup(function (e) {
        var filter = $(this).val()

        $('.card.event-list .filter-txt').each(function () {
            var txto = $(this).html();
            txt = txto
            if ((txt.toLowerCase()).includes((filter.toLowerCase())) == true) {
                $(this).closest('.card').toggle(true)
            } else {
                $(this).closest('.card').toggle(false)

            }
        })
    })

    const swiper = new Swiper('.swiper-container', {
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 2000,
        },
    });
</script>