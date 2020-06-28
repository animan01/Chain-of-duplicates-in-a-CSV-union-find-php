<?php
/**
 * Find Chain of duplicates in a CSV file.
 *
 * @author  Volodymyr Melnychuk <540991@i.ua>
 *
 */

// Define constants.
define('DUPLICATES_FIELDS', ['EMAIL', 'CARD', 'PHONE']);

// Default example data.
$csv = 'ID,PARENT_ID,EMAIL,CARD,PHONE,TMP
1,NULL,email1,card1,phone1,
2,NULL,email2,card1,phone2,
3,NULL,email3,card3,phone3,
4,NULL,email1,card2,phone4,
5,NULL,email5,card5,phone2,
6,NULL,email6,card6,phone6,
7,NULL,email3,card9,phone7,
8,NULL,email8,card10,phone8,
9,NULL,email9,card9,phone3,
10,NULL,email2,card10,phone10,';

$rows = explode(PHP_EOL, $csv);
$fields_array = [];

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

$csv_string = 'ID,PARENT_ID' . PHP_EOL;

$mapping_fields = [];
$grouping_key = [];

// Find duplicates and save to mapping.
foreach ($fields_array as $key => $array) {

  // Skip first element in array.
  if ($key === 0) {
    continue;
  }

  // Set default value for each iteration.
  $group = $group_key = NULL;
  $group_to_merge = [];

  // Grouping by fields.
  foreach (DUPLICATES_FIELDS as $field) {
    $field_value = $array[$field];
    if (array_key_exists($array[$field], $mapping_fields)) {
      $group_key = $mapping_fields[$field_value];
      $group_to_merge[] = $group_key;
    }
  }

  // Setting group if do not have any duplicates.
  if ($group_key === NULL) {
    $grouping_key[] = $array['ID'];
    $group_key = array_search($array['ID'], $grouping_key);
  }
  $group = $grouping_key[$group_key];

  // Setting minimal group if have more one group ID.
  if (count($group_to_merge) > 1) {
    for ($i = 0; $i < count($group_to_merge); $i++) {
      $merging_array[] = $grouping_key[$group_to_merge[$i]];
    }
    if (!empty($merging_array)) {
      $group = min($merging_array);
      $group_key = array_search($group, $grouping_key);
    }
  }

  // Save fields to mapping.
  $mapping_fields[$array['EMAIL']] = $group_key;
  $mapping_fields[$array['CARD']] = $group_key;
  $mapping_fields[$array['PHONE']] = $group_key;

}

foreach ($fields_array as $key => $array) {
  // Skip first element in array.
  if ($key === 0) {
    continue;
  }

  $parent_ids = NULL;
  // Searching PARENT_ID by fields.
  foreach (DUPLICATES_FIELDS as $field) {
    $parent_ids[] = $grouping_key[$mapping_fields[$array[$field]]];
  }
  $fields_array[$key]['PARENT_ID'] = min($parent_ids);

  // Prepare data from csv.
  if ($key !== 0) {
    $csv_string .= implode(',',
        [$key, $fields_array[$key]['PARENT_ID']]) . PHP_EOL;
  }
}

// Show results as string.
print_r($csv_string);
