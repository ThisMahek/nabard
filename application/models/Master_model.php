<?php
class Master_model extends CI_Model
{

    public function insert_slider($post)
    {
        return $this->db->insert('slider_and_banner', $post);
    }

    public function get_slider()
    {
        return $this->db->where('type', '1')->get('slider_and_banner')->result_array();
    }

    public function update_slider($post, $id)
    {
        return $this->db->where('id', $id)->update('slider_and_banner', $post);
    }

    public function get_banner()
    {
        return $this->db->where('type', '2')->get('slider_and_banner')->result_array();
    }

    /* -----------------Notification-------------------------*/

    public function get_notification()
    {
        // return $this->db->get('notification')->result_array();

        return $this->db->select("*")->order_by('id','desc')->get('notification')->result_array();
    }

    public function insert_notification($post)
    {
        $unread_ids = array();
        $read_ids = array();
        $insert_data = $this->db->insert('notification', $post);
        $last_id = $this->db->insert_id();
        if ($post['share_status'] == 3) {
            $unread_vendor_data = $this->db->select('id')->where(['status' => 1, 'read_notification' => null])->get('vendor')->result();
            foreach ($unread_vendor_data as $unread) {
                $unread_ids[] = $unread->id;
            }
            $unread_vendor_id = $unread_ids;
            $read_notification_data = $this->db->where(['status' => 1, 'read_notification!=' => null])->get('vendor')->result();
           /*  foreach ($read_notification_data as $read) {
                $read_ids[] = $read->id;
            }
            $read_vendor_ids = $read_ids; */
            if (!empty($read_notification_data)) {
                foreach ($read_notification_data as $read) {
                    $read_notification_json_array = json_decode($read->read_notification,1);
                    $read_notification_json_array[] = $last_id;
                    $new_read_notification_json_array = json_encode($read_notification_json_array);
                    $data['read_notification'] = $new_read_notification_json_array;
                    $this->db->where('id', $read->id)->where('status', 1)->update('vendor', $data);
                }
            }
            if (!empty($unread_vendor_data)) {
                $array = array();
                $array[] = $last_id;
                $data_unread['read_notification'] = json_encode($array);
                $this->db->where_in('id', $unread_vendor_id)->where('status', 1)->update('vendor', $data_unread);
            }
        }


        elseif ($post['share_status'] == 2) {
            $unread_vendor_data = $this->db->select('id')->where(['status' => 1,'read_notification' => null])->get('users')->result();
            foreach ($unread_vendor_data as $unread) {
                $unread_ids[] = $unread->id;
            }
            $unread_vendor_id = $unread_ids;
            $read_notification_data = $this->db->where(['status' => 1, 'read_notification!=' => null])->get('users')->result();

          /*   foreach ($read_notification_data as $read) {
                $read_ids[] = $read->id;
            }
            $read_vendor_ids = $read_ids; */
            if (!empty($read_notification_data)) {
                foreach ($read_notification_data as $read) {
                    $read_notification_json_array = json_decode($read->read_notification,1);
                    $read_notification_json_array[] = $last_id;
                    $new_read_notification_json_array = json_encode($read_notification_json_array);
                    $data['read_notification'] = $new_read_notification_json_array;
                    $this->db->where('id', $read->id)->where('status', 1)->update('users', $data);
                }
            }
            if (!empty($unread_vendor_data)) {

                $array = array();
                $array[] = $last_id;
                $data_unread['read_notification'] = json_encode($array);
                $this->db->where_in('id', $unread_vendor_id)->where('status', 1)->update('users', $data_unread);
            }
        }



        else {
            $unread_user_data = $this->db->select('id')->where(['status' => 1,'read_notification' => null])->get('users')->result();

            $unread_vendor_data = $this->db->select('id')->where(['status' => 1,'read_notification' => null])->get('vendor')->result();
            foreach ($unread_vendor_data as $unread) {
                $unread_ids[] = $unread->id;
            }
            $unread_vendor_id = $unread_ids;
            $read_notification_data_vendor = $this->db->where(['status' => 1, 'read_notification!=' => null])->get('vendor')->result();

            $read_notification_data_users = $this->db->where(['status' => 1, 'read_notification!=' => null])->get('users')->result();
           /*  foreach ($read_notification_data as $read) {
                $read_ids[] = $read->id;
            }
            $read_vendor_ids = $read_ids; */
            if (!empty($read_notification_data_vendor)) {
                foreach ($read_notification_data_vendor as $read) {
                    $read_notification_json_array = json_decode($read->read_notification,1);
                    $read_notification_json_array[] = $last_id;
                    $new_read_notification_json_array = json_encode($read_notification_json_array);
                    $data['read_notification'] = $new_read_notification_json_array;
                    $this->db->where('id', $read->id)->where('status', 1)->update('vendor', $data);
                }
            }
            if (!empty($read_notification_data_users)) {
                foreach ($read_notification_data_users as $read) {
                    $read_notification_json_array = json_decode($read->read_notification,1);
                    $read_notification_json_array[] = $last_id;
                    $new_read_notification_json_array = json_encode($read_notification_json_array);
                    $data['read_notification'] = $new_read_notification_json_array;
                    $this->db->where('id', $read->id)->where('status', 1)->update('users', $data);
                }
            }
            if (!empty($unread_vendor_data)) {

                $array = array();
                $array[] = $last_id;
                $data_unread['read_notification'] = json_encode($array);
                $this->db->where_in('id', $unread_vendor_id)->where('status', 1)->update('users', $data_unread);
            }
            if (!empty($unread_user_data)) {

                $array = array();
                $array[] = $last_id;
                $data_unread['read_notification'] = json_encode($array);
                $this->db->where_in('id', $unread_vendor_id)->where('status', 1)->update('users', $data_unread);
            }
        }
        return $insert_data;

    }

    public function update_notification($post, $id)
    {
        return $this->db->where('id', $id)->update('notification', $post);
    }

    /* ----------   Manage FAQ   ------------*/

    public function get_faq()
    {
        return $this->db->get('faq')->result_array();
    }

    public function insert_faq($post)
    {
        return $this->db->insert('faq', $post);
    }

    public function update_faq($post, $id)
    {
        return $this->db->where('id', $id)->update('faq', $post);
    }

    /* ----------   Manage Testimonials   ------------*/

    public function get_testimonial()
    {
        // return $this->db->get_where('testimonial', ['status!=' => 2])->result_array();
        
        return $this->db->select('*')->where(['status!='=>2])->order_by('id','desc')->get('testimonial')->result_array();
    }


    public function insert_testimonial($post)
    {
        return $this->db->insert('testimonial', $post);
    }

    public function update_testimonial($post, $id)
    {
        return $this->db->where('id', $id)->update('testimonial', $post);
    }

    /*   ------------ Subscriber List --------------*/

    public function get_subscriber()
    {
        return $this->db->get('subscriber')->result_array();
    }

    /*   ------------ news List --------------*/

    public function get_news()
    {
        return $this->db->where('type', '1')->get('news_event')->result_array();
    }

    public function get_event()
    {
        return $this->db->where('type', '2')->get('news_event')->result_array();
    }


    public function insert_news($post)
    {
        return $this->db->insert('news_event', $post);

    }

    public function update_news($post, $id)
    {
        return $this->db->where('id', $id)->update('news_event', $post);
    }

    public function get_district_table()
    {
        return $this->db->select('tbl_state.name as sname,district.name as dname,tbl_state.status as s_status,district.status as d_status,district.state_id,district.id as d_id,tbl_state.id as s_id')->from('district')->join('tbl_state', 'tbl_state.id = district.state_id')->where(['district.status !=' => 0])->get()->result_array();

    }






}
?>