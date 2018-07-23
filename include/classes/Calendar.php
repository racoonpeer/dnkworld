<?php

class Calendar {

    private $lang;
    private $local_time;
    private $template = '';
    private $start_day = 'monday';
    private $month_type = 'long';
    private $day_type = 'abr';
    private $show_next_prev = FALSE;
    private $next_prev_url = '';

    public function __construct($config = array()) {
	$this->local_time = time();
	if (count($config) > 0) {
	    $this->initialize($config);
	}
    }

    function initialize($config = array()) {
	foreach ($config as $key => $val) {
	    if (isset($this->$key)) {
		$this->$key = $val;
	    }
	}
    }

    // --------------------------------------------------------------------

    /**
     * Generate the calendar
     *
     * @access	public
     * @param	integer	the year
     * @param	integer	the month
     * @param	array	the data to be shown in the calendar cells
     * @return	string
     */
    function generate($year = '', $month = '', $data = array()) {
	// Set and validate the supplied month/year
	if ($year == '')
	    $year = date("Y", $this->local_time);

	if ($month == '')
	    $month = date("m", $this->local_time);

	if (strlen($year) == 1)
	    $year = '200' . $year;

	if (strlen($year) == 2)
	    $year = '20' . $year;

	if (strlen($month) == 1)
	    $month = '0' . $month;

	$adjusted_date = $this->adjust_date($month, $year);

	$month = $adjusted_date['month'];
	$year = $adjusted_date['year'];

	// Determine the total days in the month
	$total_days = $this->get_total_days($month, $year);

	// Set the starting day of the week
	$start_days = array('sunday' => 0, 'monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6);
	$start_day = (!isset($start_days[$this->start_day])) ? 0 : $start_days[$this->start_day];

	// Set the starting day number
	$local_date = mktime(12, 0, 0, $month, 1, $year);
	$date = getdate($local_date);
	$day = $start_day + 1 - $date["wday"];

	while ($day > 1) {
	    $day -= 7;
	}

	// Set the current month/year/day
	// We use this to determine the "today" date
	$cur_year = date("Y", $this->local_time);
	$cur_month = date("m", $this->local_time);
	$cur_day = date("j", $this->local_time);

	$is_current_month = ($cur_year == $year AND $cur_month == $month) ? TRUE : FALSE;

	// Generate the template data array
	$this->parse_template();

	// Begin building the calendar output
	$out = $this->temp['table_open'];
	$out .= "\n";

	$out .= "\n";
	$out .= $this->temp['heading_row_start'];
	$out .= "\n";

	// "previous" month link
	if ($this->show_next_prev == TRUE) {
	    // Add a trailing slash to the  URL if needed
	    $this->next_prev_url = preg_replace("/(.+?)\/*$/", "\\1/", $this->next_prev_url);

	    $adjusted_date = $this->adjust_date($month - 1, $year);
	    $out .= str_replace('{previous_url}', $this->next_prev_url . $adjusted_date['year'] . '/' . $adjusted_date['month'], $this->temp['heading_previous_cell']);
	    $out .= "\n";
	}

	// Heading containing the month/year
	$colspan = ($this->show_next_prev == TRUE) ? 5 : 7;

	$this->temp['heading_title_cell'] = str_replace('{colspan}', $colspan, $this->temp['heading_title_cell']);
	$this->temp['heading_title_cell'] = str_replace('{heading}', $this->get_month_name($month) . "&nbsp;" . $year, $this->temp['heading_title_cell']);

	$out .= $this->temp['heading_title_cell'];
	$out .= "\n";

	// "next" month link
	if ($this->show_next_prev == TRUE) {
	    $adjusted_date = $this->adjust_date($month + 1, $year);
	    $out .= str_replace('{next_url}', $this->next_prev_url . $adjusted_date['year'] . '/' . $adjusted_date['month'], $this->temp['heading_next_cell']);
	}

	$out .= "\n";
	$out .= $this->temp['heading_row_end'];
	$out .= "\n";

	// Write the cells containing the days of the week
	$out .= "\n";
	$out .= $this->temp['week_row_start'];
	$out .= "\n";

	$day_names = $this->get_day_names();

	for ($i = 0; $i < 7; $i++) {
	    $out .= str_replace('{week_day}', $day_names[($start_day + $i) % 7], $this->temp['week_day_cell']);
	}

	$out .= "\n";
	$out .= $this->temp['week_row_end'];
	$out .= "\n";
	// Build the main body of the calendar
	while ($day <= $total_days) {
	    $out .= "\n";
	    $out .= $this->temp['cal_row_start'];
	    $out .= "\n";
	    for ($i = 0; $i < 7; $i++) {
                
		$out .= (isset($data[$day])) ? $this->temp['cal_cell_active_start'] : $this->temp['cal_cell_start'];
		if ($day > 0 AND $day <= $total_days) {
		    if (isset($data[$day])) {
			// Cells with content
			$temp = ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_content_today'] : $this->temp['cal_cell_content'];
                        $out .= str_replace('{title}', $data[$day]['title'], str_replace('{day}', $day, str_replace('{content}', $data[$day]['link'], $temp)));
		    } else {
			// Cells with no content
			$temp = ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_no_content_today'] : $this->temp['cal_cell_no_content'];
			$out .= str_replace('{day}', $day, $temp);
		    }
		} else {
		    // Blank cells
		    $out .= $this->temp['cal_cell_blank'];
		}

		$out .= ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_end_today'] : $this->temp['cal_cell_end'];
		$day++;
	    }
	    $out .= "\n";
	    $out .= $this->temp['cal_row_end'];
	    $out .= "\n";
	}
	$out .= "\n";
	$out .= $this->temp['table_close'];
	return $out;
    }

    // --------------------------------------------------------------------

    function get_month_name($month) {
	if ($this->month_type == 'short') {
	    $month_names = array('01' => 'jan', '02' => 'feb', '03' => 'mar', '04' => 'apr', '05' => 'may', '06' => 'jun', '07' => 'jul', '08' => 'aug', '09' => 'sep', '10' => 'oct', '11' => 'nov', '12' => 'dec');
	} else {
	    $month_names = array('01' => '������', '02' => '�������', '03' => '����', '04' => '������', '05' => '���', '06' => '����', '07' => '����', '08' => '������', '09' => '��������', '10' => '�������', '11' => '������', '12' => '�������');
	}
	$month = $month_names[$month];
	return $month;
    }

    // --------------------------------------------------------------------

    function get_day_names($day_type = '') {
	if ($day_type != '') {
	    $this->day_type = $day_type;
	}
	if ($this->day_type == 'long') {
	    $day_names = array('�����������', '�����������', '�������', '�����', '�������', '�������', '�������');
	} elseif ($this->day_type == 'short') {
	    $day_names = array('���', '���', '���', '���', '���', '���', '���');
	} else {
	    $day_names = array('��', '��', '��', '��', '��', '��', '��');
	}
	$days = array();
	foreach ($day_names as $val) {
	    $days[] = $val;
	}
	return $days;
    }

    // --------------------------------------------------------------------

    function adjust_date($month, $year) {
	$date = array();
	$date['month'] = $month;
	$date['year'] = $year;
	while ($date['month'] > 12) {
	    $date['month'] -= 12;
	    $date['year']++;
	}
	while ($date['month'] <= 0) {
	    $date['month'] += 12;
	    $date['year']--;
	}
	if (strlen($date['month']) == 1) {
	    $date['month'] = '0' . $date['month'];
	}
	return $date;
    }

    // --------------------------------------------------------------------

    function get_total_days($month, $year) {
	$days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	if ($month < 1 OR $month > 12) {
	    return 0;
	}
	// Is the year a leap year?
	if ($month == 2) {
	    if ($year % 400 == 0 OR ($year % 4 == 0 AND $year % 100 != 0)) {
		return 29;
	    }
	}
	return $days_in_month[$month - 1];
    }

    // --------------------------------------------------------------------

    function default_template() {
	return array(
		'table_open' => '<table width="100%" border="0" cellpadding="4" cellspacing="0" id="calendar" class="calendarTable">',
		'heading_row_start' => '<tr>',
		'heading_previous_cell' => '<th><a href="{previous_url}">&lt;&lt;</a></th>',
		'heading_title_cell' => '<th colspan="{colspan}">{heading}</th>',
		'heading_next_cell' => '<th><a href="{next_url}">&gt;&gt;</a></th>',
		'heading_row_end' => '</tr>',
		'week_row_start' => '<tr>',
		'week_day_cell' => '<th>{week_day}</th>',
		'week_row_end' => '</tr>',
		'cal_row_start' => '<tr>',
		'cal_cell_start' => '<td>',
		'cal_cell_active_start' => '<td class="active">',
		'cal_cell_start_today' => '<td>',
		'cal_cell_content' => '<a href="{content}" title="{title}">{day}</a>',
		'cal_cell_content_today' => '<a href="{content}" title="{title}">{day}</a>',
		'cal_cell_no_content' => '{day}',
		'cal_cell_no_content_today' => '{day}',
		'cal_cell_blank' => '',
		'cal_cell_end' => '</td>',
		'cal_cell_end_today' => '</td>',
		'cal_row_end' => '</tr>',
		'table_close' => '</table>'
	);
    }

    // --------------------------------------------------------------------

    function parse_template() {
	$this->temp = $this->default_template();

	if ($this->template == '') {
	    return;
	}

	$today = array('cal_cell_start_today', 'cal_cell_content_today', 'cal_cell_no_content_today', 'cal_cell_end_today');

	foreach (array('table_open', 'table_close', 'heading_row_start', 'heading_previous_cell', 'heading_title_cell', 'heading_next_cell', 'heading_row_end', 'week_row_start', 'week_day_cell', 'week_row_end', 'cal_row_start', 'cal_cell_start', 'cal_cell_content', 'cal_cell_no_content', 'cal_cell_blank', 'cal_cell_end', 'cal_row_end', 'cal_cell_start_today', 'cal_cell_content_today', 'cal_cell_no_content_today', 'cal_cell_end_today') as $val) {
	    if (preg_match("/\{" . $val . "\}(.*?)\{\/" . $val . "\}/si", $this->template, $match)) {
		$this->temp[$val] = $match['1'];
	    } else {
		if (in_array($val, $today, TRUE)) {
		    $this->temp[$val] = $this->temp[str_replace('_today', '', $val)];
		}
	    }
	}
    }

}

