<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM transcript_form where id=" . $_GET['id'])->fetch_array();
    foreach ($qry as $k => $v) {
        $$k = $v;
    }
}
?>
<div class="container-fluid">
    <p>Name: <b>
            <large><?php echo ucwords($name) ?></large>
        </b></p>
    <p>ID Number: <b>
            <large><?php echo ucwords($id_no) ?></large>
        </b></p>
    <p>Graduation Date: <b>
            <large><?php echo ucwords($graduation_date) ?></large>
        </b></p>
    <p>Program Type: <b>
            <large><?php echo ucwords($program_type) ?></large>
        </b></p>
    <p>Degree Type: <b>
            <large><?php echo ucwords($degree_type) ?></large>
        </b></p>
    <p>Department: <b>
            <large><?php echo ucwords($department) ?></large>
        </b></p>
    <p>Name of Institution: <b>
            <large><?php echo ucwords($name_of_institution) ?></large>
        </b></p>
    <p>Address of Institution: <b>
            <large><?php echo ucwords($addr_of_institution) ?></large>
        </b></p>
        <p>Cost Sharing Letter: <b>
            <large>
                <div class="image-container">
                    <img src="img/<?php echo $qry["cost_sharing"]; ?>" class="image"
                        title="<?php echo $qry['cost_sharing']; ?>">
                    <div class="fullscreen-overlay">
                        <img src="img/<?php echo $qry["cost_sharing"]; ?>" class="fullscreen-image"
                            title="<?php echo $qry['cost_sharing']; ?>">
                    </div>
                </div>
            </large>
        </b></p>
    <div class="modal-footer display">
        <div class="row">
            <div class="col-md-12">
                <a href="index.php?page=select_action"><button class="btn float-right btn-primary mx-1" type="submit">
                        Select Action</button></a>
                <button class="btn float-right btn-secondary mx-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    <hr class="divider">
</div>

<style>
    p {
        margin: unset;
    }

    #uni_modal .modal-footer {
        display: none;
    }

    #uni_modal .modal-footer.display {
        display: block;
    }
    
    .image-container {
        position: relative;
        cursor: pointer;
    }

    .fullscreen-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s, visibility 0.3s;
        z-index: 999;
    }

    .fullscreen-image {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
    }

    .fullscreen-overlay.show {
        opacity: 1;
        visibility: visible;
    }
</style>
<script>
    $('.text-jqte').jqte();
    $('#manage-career').submit(function (e) {
        e.preventDefault()
        start_load()
        $.ajax({
            url: 'admin/ajax.php?action=save_career',
            method: 'POST',
            data: $(this).serialize(),
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Data successfully saved.", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1000)
                }
            }
        })
    })
    document.querySelectorAll('.image-container').forEach((container) => {
        const image = container.querySelector('.image');
        const fullscreenOverlay = container.querySelector('.fullscreen-overlay');
        const fullscreenImage = fullscreenOverlay.querySelector('.fullscreen-image');

        image.addEventListener('click', () => {
            fullscreenOverlay.classList.add('show');
        });

        fullscreenOverlay.addEventListener('click', () => {
            fullscreenOverlay.classList.remove('show');
        });
    });
</script>