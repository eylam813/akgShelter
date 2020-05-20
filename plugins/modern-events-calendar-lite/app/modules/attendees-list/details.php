<?php
/** no direct access **/
defined('MECEXEC') or die();

// MEC Settings
$settings = $this->get_settings();

// BuddyPress integration is disabled
if(!isset($settings['bp_status']) or (isset($settings['bp_status']) and !$settings['bp_status'])) return;
        
// Attendees Module is disabled
if(!isset($settings['bp_attendees_module']) or (isset($settings['bp_attendees_module']) and !$settings['bp_attendees_module'])) return;

// BuddyPress is not installed or activated
if(!function_exists('bp_activity_add')) return;

$date = $event->date;
$start_date = (isset($date['start']) and isset($date['start']['date'])) ? $date['start']['date'] : date('Y-m-d');

$limit = isset($settings['bp_attendees_module_limit']) ? $settings['bp_attendees_module_limit'] : 20;
$bookings = $this->get_bookings($event->data->ID, $start_date, $limit);

// Book Library
$book = $this->getBook();

// Start Date belongs to future but booking module cannot show so return without any output
if(!$this->can_show_booking_module($event) and strtotime($start_date) > time()) return;

$attendees = array();
foreach($bookings as $booking)
{
    $attendees[$booking->post_author] = $booking->ID;
}
?>
<div class="mec-attendees-list-details mec-frontbox" id="mec_attendees_list_details">
    <h3 class="mec-attendees-list mec-frontbox-title"><?php _e('Event Attendees', 'modern-events-calendar-lite'); ?></h3>
    <?php if(!count($attendees)): ?>
    <p><?php _e('No attendee found! Be the first one to book!', 'modern-events-calendar-lite'); ?></p>
    <?php else: ?>
    <ul>
        <?php do_action('mec_attendeed_hook', $attendees); foreach($attendees as $attendee_id=>$booking_id): ?>
        <li>
            <div class="mec-attendee-avatar">
                <a href="<?php echo bp_core_get_user_domain($attendee_id); ?>" title="<?php echo bp_core_get_user_displayname($attendee_id); ?>">
                    <?php echo bp_core_fetch_avatar(array('item_id'=>$attendee_id, 'type'=>'thumb')); ?>
                </a>
            </div>
            <?php
                $link = bp_core_get_userlink($attendee_id, false, true);
                $user = get_userdata($attendee_id);

                $name = trim($user->first_name.' '.$user->last_name);
                if(!$name) $name = $user->display_name;
            ?>
            <div class="mec-attendee-profile-link">
                <?php echo '<a href="'.$link.'">'.$name.'</a>' . '<span class="mec-attendee-profile-ticket-number mec-bg-color">'. $book->get_total_attendees($booking_id) .'</span>' . '<span class="mec-color-hover"> ' . esc_html__( 'tickets' , 'modern-events-calendar-lite' ) . '<i class="mec-sl-arrow-down"></i></span>' ; ?>
            </div>

            <!-- MEC BuddyPress Integration Attendees Modules -->
            <div class="mec-attendees-toggle mec-util-hidden">
            <?php
                $mec_attendees = array_filter(get_post_meta($booking_id, 'mec_attendees', true));
                $mec_attendees_count = count($mec_attendees);

                // For Sorting And Filtering MEC Attendees Array.
                for($i = 0; $i < $mec_attendees_count; $i++)
                {
                    if(array_key_exists($mec_attendees[$i]['email'], $mec_attendees))
                    {
                        $mec_attendees[$mec_attendees[$i]['email']]['count'] += $mec_attendees[$i]['count'];
                    }
                    else
                    {
                        $mec_attendees[$mec_attendees[$i]['email']] = $mec_attendees[$i];
                    }

                    unset($mec_attendees[$mec_attendees[$i]['email']]['id']);
                    unset($mec_attendees[$mec_attendees[$i]['email']]['reg']);
                    unset($mec_attendees[$mec_attendees[$i]['email']]['variations']);
                    unset($mec_attendees[$i]);
                }

                // For Display Sorting Output.
                foreach($mec_attendees as $mec_attendee)
                {
                    ?>
                    <div class="mec-attendees-item clearfix">
                        <?php
                            $new_attendee_array = array(  'email' => '', 'name' => '', 'count' => ''  );
                            foreach($mec_attendee as $mec_attendee_item_key => $mec_attendee_item_value)
                            {
                                if( $mec_attendee_item_key == 'count' ) $new_attendee_array['count'] = $mec_attendee_item_value;
                                if( $mec_attendee_item_key == 'name' ) $new_attendee_array['name'] = $mec_attendee_item_value;
                                if( $mec_attendee_item_key == 'email' ) $new_attendee_array['email'] = $mec_attendee_item_value;
                            }
                            foreach ($new_attendee_array as $new_attendee_key => $new_attendee_value ) {
                                if ( $new_attendee_key == 'email' ) echo '<div class="mec-attendee-avatar-sec">'. get_avatar($new_attendee_value , '50') .'</div>';
                                if ( $new_attendee_key == 'name' ) echo '<div class="mec-attendee-profile-name-sec">'. $new_attendee_value .'</div>';
                                if ( $new_attendee_key == 'count' ) echo '<span class="mec-attendee-profile-ticket-sec">'. $new_attendee_value . ( $new_attendee_value > 1 ? ' tickets' : ' ticket' ) . '</span>';
                            }  
                            
                        ?>
                    </div>
                    <?php
                }
            ?>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>