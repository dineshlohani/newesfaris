<table border='1'>
    <thead style='background-color:grey;'>
    <tr>
        <th scope="col">दर्ता नं.</th>
        <th scope="col">दर्ता मिति</th>
        <th scope="col">पत्र संख्या</th>
        <th scope="col">पठाउने कार्यालय वा व्यक्तिको विवरण</th>
        <th scope="col">प्राप्त पत्रको विवरण</th>
        <th scope="col">बुझिलिनेको नाम</th>
    </tr>
    </thead>
    <tbody>
        <?php
            if(!isset($result) || $result == FALSE)
            {
        ?>
        <tr>

                <td class="text-danger text-center" colspan="8"><h5>डाटाबेसमा कुनै डाटा छैन | </h5></td>


        </tr>
        <?php
            }
            else
            {
                $i = 1;
                foreach($result as $data)
                {
                    if(!empty($data->uri))
                    {
                        $patra          = Modules::run("Settings/getPatraItemByURI",$data->uri);
                        $letter_subject = $patra->name;
                    }
                    else
                    {
                        $letter_subject = $data->letter_subject;
                    }
                    $session = Modules::run('Settings/getSession',$data->session_id);
                    $user = $this->Mdl_user->getById($data->user_id);
        ?>
        <tr>
            <td> <?= convertedcit($data->darta_no) ?> </td>
            <td> <?= convertedcit($data->nepali_darta_miti) ?></td>
            <td> <?= convertedcit($session->name) ?>   </td>
            <td> <?= $data->applicant_name ?> </td>
            <td> <?= $letter_subject ?> </td>
            <td> <?= ($user != FALSE) ? $user->name : '-'?> </td>
        </tr>
        <?php
                    $i++;
                }
            }
        ?>



    </tbody>
</table>
