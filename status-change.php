 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 Change Status by onclick
 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

 <td>
    <?php
    if($event['status']==1)
    {
        ?>
        <button type="button" class="btn btn-success m-r-5 m-b-5" onclick="get_active(<?php echo $event['id']; ?>,0);">Active
        </button>
        <?php
    }
    else
    {
        ?>
        <button type="button" class="btn btn-danger m-r-5 m-b-5" onclick="get_active(<?php echo $event['id']; ?>,1);">Deactive
        </button>
        <?php
    }
    ?>
</td>

<script>
    function get_active(id,status)
    {
        $.ajax
        ({
            type: "POST",
            data : {id:id , status : status },
            url: "<?php echo base_url('events/updateStatus');?>",
            success: function (result)
            {

                if(result==0)
                {
                    location.reload();
                }
                else if(result==1)
                {
                    location.reload();
                }
                else
                {

                }

            }
        });
    }
</script>


<?php 

// CONTROLLER FILE 

public function updateStatus()
    {
        $id = $this->input->post("id");
        $result = 0;
        $data = array(
            'status' => $this->input->post("status"),
            'u_date' => date("Y-m-d H:i:s"),
        );
        $updateResult = $this->Events_model->updateStatus($id, $data);
        if ($updateResult === TRUE) {
            $result = 1;
        } else {
            $result = 0;
        }
        echo $result;
    }

// MODEL FILE 

    public function updateStatus($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_events',$data);
    }

?>






