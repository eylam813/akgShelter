<?php
/** no direct access **/
defined('MECEXEC') or die();

// MEC Settings
$settings = $this->get_settings();

// The module is disabled
if(!isset($settings['local_time_module_status']) or (isset($settings['local_time_module_status']) and !$settings['local_time_module_status'])) return;

// Get the visitor Timezone
$timezone = $this->get_timezone_by_ip();

// Timezone is not detected!
if(!$timezone) return;

$minutes        = isset($event->data->meta['mec_date']['start']['minutes']) ? $event->data->meta['mec_date']['start']['minutes'] : '';
$ampm           = isset($event->data->meta['mec_date']['start']['ampm']) ? $event->data->meta['mec_date']['start']['ampm'] : '';
$hour           = isset($event->data->meta['mec_date']['start']['hour']) ? $event->data->meta['mec_date']['start']['hour'] : '';
$endminutes     = isset($event->data->meta['mec_date']['end']['minutes']) ? $event->data->meta['mec_date']['end']['minutes'] : '';
$endampm        = isset($event->data->meta['mec_date']['end']['ampm']) ? $event->data->meta['mec_date']['end']['ampm'] : '';
$endhour        = isset($event->data->meta['mec_date']['end']['hour']) ? $event->data->meta['mec_date']['end']['hour'] : '';

// Date Formats
$date_format1 = (isset($settings['single_date_format1']) and trim($settings['single_date_format1'])) ? $settings['single_date_format1'] : 'M d Y';
$time_format = get_option('time_format', 'H:i');

$occurrence = isset($_GET['occurrence']) ? sanitize_text_field($_GET['occurrence']) : '';
$occurrence_end_date = trim($occurrence) ? $this->get_end_date_by_occurrence($event->data->ID, (isset($event->date['start']['date']) ? $event->date['start']['date'] : $occurrence)) : '';

$gmt_offset_seconds = $this->get_gmt_offset_seconds((trim($occurrence) ? $occurrence : $event->date['start']['date']));

$gmt_start_time = strtotime((trim($occurrence) ? $occurrence : $event->date['start']['date']).' '.sprintf("%02d", $hour).':'.sprintf("%02d", $minutes).' '.$ampm) - $gmt_offset_seconds;
$gmt_end_time = strtotime((trim($occurrence_end_date) ? $occurrence_end_date : $event->date['end']['date']).' '.sprintf("%02d", ($endhour == '0') ? '12' : $endhour).':'.sprintf("%02d", $endminutes).' '.$endampm) - $gmt_offset_seconds;

$user_timezone = new DateTimeZone($timezone);
$gmt_timezone = new DateTimeZone('GMT');
$gmt_datetime = new DateTime(date('Y-m-d H:i:s', $gmt_start_time), $gmt_timezone);
$offset = $user_timezone->getOffset($gmt_datetime);

$user_start_time = $gmt_start_time + $offset;
$user_end_time = $gmt_end_time + $offset;

$allday = isset($event->data->meta['mec_allday']) ? $event->data->meta['mec_allday'] : 0;
$hide_time = isset($event->data->meta['mec_hide_time']) ? $event->data->meta['mec_hide_time'] : 0;
$hide_end_time = isset($event->data->meta['mec_hide_end_time']) ? $event->data->meta['mec_hide_end_time'] : 0;
?>
<div class="mec-localtime-details" id="mec_localtime_details">
    <div class="mec-localtime-wrap">
        <i class="mec-sl-clock"></i>
        <span class="mec-localtitle"><?php _e('Local Time:', 'modern-events-calendar-lite'); ?></span>
        <div class="mec-localdate"><?php echo sprintf(__('%s |', 'modern-events-calendar-lite'), $this->date_label(array('date'=>date('Y-m-d', $user_start_time)), array('date'=>date('Y-m-d', $user_end_time)), $date_format1)); ?></div>
        <?php if(!$hide_time and trim($time_format)): ?>
        <div class="mec-localtime"><?php echo sprintf(__('%s', 'modern-events-calendar-lite'), '<span>'.($allday ? __('All Day', 'modern-events-calendar-lite') : ($hide_end_time ? date($time_format, $user_start_time) : date($time_format, $user_start_time).' - '.date($time_format, $user_end_time))).'</span>'); ?></div>
        <?php endif; ?>
    </div>
</div>