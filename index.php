<?php
/**
 * Find Chain of duplicates in a CSV file.
 *
 * @author  Roman Zakharchuk <extatic.dancer@gmail.com>
 * @author  Volodymyr Melnychuk <540991@i.ua>
 *
 */

// Default example data.
$csv = 'ID,PARENT_ID,EMAIL,CARD,PHONE,TMP
1,NULL,email1,card1,phone1,
2,NULL,email2,card2,phone2,
3,NULL,email3,card3,phone3,
4,NULL,email1,card2,phone4,                                                                                                                                                          
5,NULL,email5,card5,phone2,
6,NULL,email6,card6,phone6,
7,NULL,email3,card9,phone7,
8,NULL,email8,card10,phone8,
9,NULL,email9,card9,phone3,                                                                                                                                                          
10,NULL,email10,card10,phone10,';

$rows = explode(PHP_EOL, $csv);

// Prepare array data.
foreach ($rows as $key => $row) {
  $items_data[$key] = explode(',', $row);

  $fields_array[$key] = [
    'ID' => $items_data[$key][0],
    'PARENT_ID' => $items_data[$key][1],
    'EMAIL' => $items_data[$key][2],
    'CARD' => $items_data[$key][3],
    'PHONE' => $items_data[$key][4],
    'TMP' => $items_data[$key][5],
  ];
}

// Get all rows for fields.
$ids = array_column($fields_array, 'ID');
$emails = array_column($fields_array, 'EMAIL');
$cars = array_column($fields_array, 'CARD');
$phones = array_column($fields_array, 'PHONE');

$results = [];
$csv_string = 'ID,PARENT_ID' . PHP_EOL;

// Prepare data for csv.
foreach ($fields_array as $key => $array) {

  $ids_by_mail = get_duplicate_array($emails, 'EMAIL', $array['EMAIL']);
  $ids_by_card = get_duplicate_array($cars, 'CARD', $array['CARD']);
  $ids_by_phone = get_duplicate_array($phones, 'PHONE', $array['PHONE']);

  $min_ids = [
    min($ids_by_mail),
    min($ids_by_card),
    min($ids_by_phone),
  ];

  $min_id = min($min_ids);

  fill_results($ids_by_mail, $results, $min_id);
  fill_results($ids_by_card, $results, $min_id);
  fill_results($ids_by_phone, $results, $min_id);

}

ksort($results);

// Prepare string for csv.
foreach ($results as $key => $result) {
  if ($key !== 0) {
    $csv_string .= implode(',', [$key, $results[$key]['PARENT_ID']]) . PHP_EOL;
  }
}

//print_r($results);
// Show results as string.
print_r($csv_string);

/**
 * Return founded duplicates key.
 *
 * @param array $array
 *    Array with fields.
 * @param $column
 *    Field name.
 * @param $string
 *    Search string.
 *
 * @return array|bool
 */
function get_duplicate_array($array, $column, $string) {

  $results = array_filter($array,
    function ($value) use ($string) {
      if ($value === $string) {
        return TRUE;
      }
      return FALSE;
    },
    ARRAY_FILTER_USE_BOTH);

  $results = array_fill_keys(array_keys($results), min(array_keys($results)));

  if (count($results) > 0) {
    return $results;
  }
  else {
    return [];
  }

}

/**
 * Get fill results.
 *
 * @param $array
 *   Array.
 * @param $results
 *   Row results.
 * @param $min_id
 *  Minimal ID.
 */
function fill_results($array, &$results, $min_id) {
  foreach ($array as $id => $value) {
    if (empty($results[$id]) || $results[$id] > $min_id) {
      $results[$id]['PARENT_ID'] = $min_id;
    }
  }
}
