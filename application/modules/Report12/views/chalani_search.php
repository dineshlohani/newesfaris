<table class="table table-responsive-sm table-responsive-md table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">क्र.सं.</th>
            <th scope="col">सिरफिसको किसिम </th>
            <th scope="col"> चलानी संख्या </th>
            <th scope="col"># </th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; if(!empty($item_count)) :
        foreach($item_count as $key => $chalani) : ?>
        <tr>
            <td><?php echo  $i++?></td>
            <td><?php echo  $chalani['name']?></td>
            <td><?php echo  $chalani['totalcount']?></td>
            <td><a href="" class="btn btn-info" style="color:#fff">सुची हेर्नुहोस्</a></td>
        </tr>
        <?php endforeach;endif;?>
    </tbody>
</table>