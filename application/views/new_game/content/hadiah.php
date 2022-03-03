<div class="container">
    <div class="card">
        <div class="card-body">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <!-- <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th> -->
                        <th scope="col">Hadiah</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Bonus </th>
                        <th scope="col">Poin</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($hadiah); $i++) { ?>
                        <tr>

                            <!-- <th scope="row">1</th> -->
                            <td><?php echo $hadiah[$i]['name']; ?></td>
                            <td> <img src="<?php echo $hadiah[$i]['picture']; ?>" style="width:35px; height:35px;" alt=""> </td>
                            <td><?php echo $hadiah[$i]['jumlah']; ?></td>
                            <td><?php echo $hadiah[$i]['poin']; ?></td>
                            <td>
                                <center><a href="<?php echo $this->config->item('base_url'); ?>hadiah/penukaran_hadiah/<?php echo $hadiah[$i]['id']; ?>?access=<?php echo $_GET['access']; ?>" class="btn btn-primary-ungu mb-4">Tukar Poin</a></center>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>