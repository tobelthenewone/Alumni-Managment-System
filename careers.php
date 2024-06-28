<h4?php
include 'admin/db_connect.php';
?>

<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card-custom {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
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

        .gallery-list {
            cursor: pointer;
            border: unset;
            flex-direction: inherit;
        }

        .gallery-img,
        .gallery-list .card-body {
            width: calc(50%)
        }

        .gallery-img img {
            border-radius: 5px;
            min-height: 50vh;
            max-width: calc(100%);
        }

        span.hightlight {
            background: yellow;
        }

        .carousel,
        .carousel-inner,
        .carousel-item {
            min-height: calc(100%)
        }

        header.masthead,
        header.masthead:before {
            min-height: 50vh !important;
            height: 50vh !important
        }

        .row-items {
            position: relative;
        }

        .masthead {
            min-height: 23vh !important;
            height: 23vh !important;
        }

        .masthead:before {
            min-height: 23vh !important;
            height: 23vh !important;
        }
    </style>
</head>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h1 class="text-white">Job List</h1>
                <hr class="divider my-4 mx-auto" />

            </div>

        </div>
    </div>
</header>
<div class="container mt-3 pt-2">
    <div class="bg-black card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="filter-field"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Filter" id="filter" aria-label="Filter"
                            aria-describedby="filter-field">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-block btn-sm" id="search">Search</button>
                </div>
            </div>

        </div>
    </div>
    <?php
    $event = $conn->query("SELECT c.*,u.name from careers c inner join users u on u.id = c.user_id order by id desc");
    while ($row = $event->fetch_assoc()):
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['description']), $trans);
        $desc = str_replace(array("<li>", "</li>"), array("", ","), $desc);
        ?>
        <div>
            <div data-aos="fade-up" class="card bg-black card-custom job-list" data-id="<?php echo $row['id'] ?>">
                <div class="card-body">
                    <div class="text-white align-items-center justify-content-center text-center h-100">
                        <div class="">
                            <h3><b class="text-white filter-txt"><?php echo ucwords($row['job_title']) ?></b></h3>
                            <div>
                                <span class="filter-txt"><small><b><i class="fa fa-building"></i>
                                            <?php echo ucwords($row['company']) ?></b></small></span>
                                <span class="filter-txt"><small><b><i class="fa fa-map-marker"></i>
                                            <?php echo ucwords($row['location']) ?></b></small></span>
                            </div>
                            <hr>
                            <h4 class="text-white truncate filter-txt"><?php echo strip_tags($desc) ?></h4>
                            <br>
                            <hr class="divider" style="max-width: calc(100%)">
                            <span class="badge badge-info float-left px-3 pt-1 pb-1">
                                <b><i>Posted by: <?php echo $row['name'] ?></i></b>
                            </span>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <br>
    <?php endwhile; ?>

</div>

</div>


<script>
    // $('.card.gallery-list').click(function(){
    //     location.href = "index.php?page=view_gallery&id="+$(this).attr('data-id')
    // })
    $('#new_career').click(function () {
        uni_modal("New Job Hiring", "manage_career.php", 'mid-large')
    })
    $('.read_more').click(function () {
        uni_modal("Career Opportunity", "view_jobs.php?id=" + $(this).attr('data-id'), 'mid-large')
    })
    $('.gallery-img img').click(function () {
        viewer_modal($(this).attr('src'))
    })

    $('#filter').keypress(function (e) {
        if (e.which == 13)
            $('#search').trigger('click')
    })
    $('#search').click(function () {
        var txt = $('#filter').val()
        start_load()
        if (txt == '') {
            $('.job-list').show()
            end_load()
            return false;
        }
        $('.job-list').each(function () {
            var content = "";
            $(this).find(".filter-txt").each(function () {
                content += ' ' + $(this).text()
            })
            if ((content.toLowerCase()).includes(txt.toLowerCase()) == true) {
                $(this).toggle(true)
            } else {
                $(this).toggle(false)
            }
        })
        end_load()
    })

</script>