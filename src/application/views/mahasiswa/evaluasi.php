<!-- <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSfkfD48Kre12DAQo3Xvwj-iorCiEpsD4oPN-zC-WhWcU9tgIg/viewform?embedded=true" width="700" height="520" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe> -->
<?php
    if ($akses==true) {
        ?>
        <div class="d-flex justify-content-center" >
        <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSeTTBIZsT5CRzUBiWyei2YrujwQ01CQxs43fDIpgdbJORm5Iw/viewform?embedded=true" width="700" height="520" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
        </div>

        <?php
    }else{
        ?>
        <div class="d-flex justify-content-center" ><iframe src="https://docs.google.com/forms/d/e/1FAIpQLSf2xN6WJgewXtu7fslTTbhiOYON604QtA8w4gbaLwFyZRUwaA/viewform?embedded=true" width="700" height="520" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe> </div>
        <form method="post" action='<?php echo site_url('mahasiswa/doneMhs'); ?>'>
        <input type="hidden" name="akses" class="form-control" value="evaluasi" >
        <p>jika sudah mengerjakan soal evaluasi silahkan "submit" terlebih dahulu lalu <button class="btn btn-primary type="submit"> klik disini </button></p>
        </form>
        <?php
    }
    ?>