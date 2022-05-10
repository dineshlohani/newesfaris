<?php if(!empty($result)) : ?>
<table class="table table-responsive-sm table-responsive-md table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">क्र.सं.</th>
            <th scope="col">पत्रको विषय</th>
            <th scope="col">दर्ता संख्या </th>
            <th scope="col">#</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; if(!empty($result)) :
            foreach($result as $key => $darta) :
            $patra_name = $this->Mdl_patra_item->getNameByUri($darta->uri);
            // print_r($patra_name);
            $patra_category = $this->Mdl_patra_category->getById($patra_name->category_id);
            ?>
            <tr>
                <td><?php echo  $i++?></td>
                <td><?php echo  $patra_name->name?>(<?php echo $patra_category->name?>)</td>
                <td><?php echo  $darta->total_sifaris?></td>
                <td>
                    <?php if($darta->total_sifaris > 0 ): ?>
                    <a href="<?php echo base_url()?>Report/DartaSuchi/<?php echo $darta->uri?>" class="btn btn-info" style="color:#fff">दर्ता सुची हेर्नुहोस्</a>
                <?php endif;?>
                </td>
            </tr>
        <?php endforeach;endif;?>
    </tbody>
</table>
<?php else : ?>
    <div class="alert alert-danger">सिफारिस जारी गरिएको छैन</div>
<?php endif;?>