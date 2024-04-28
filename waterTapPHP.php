<?php

// Define a function that we'll need to use later
// This function works exactly the same way as the "min" function, except it returns the INDEX of the value which is minimum, not the VALUE of the value which is minimum
function min_index($array) {
	$min_index = null;
	$minValue = null;
	foreach ($array as $i => $value) {
		if ($minValue === null || $value < $minValue) {
			$min_index = $i;
			$minValue = $value;
		}
	}
	return $min_index;
}

// Define our actual important function
function calculateTime($q, $tapFlows, $walkingTime) {
	
	// Defaulting the values in case omitted
	if($q == null) {
		$q = [400, 750, 1000];
	}
	
	if($tapFlows == null) {
		$tapFlows = [100, 100];
	}
	
	if($walkingTime == null) {
		$walkingTime = 0;
	}
	
	// $tapTimes is the total time people have spent at each tap as we move down the queue.
	// Before the loop, this is initialised as [0, 0, 0, ....., 0] with one zero for each tap
	$tapTimes = array_fill(0, count($tapFlows), 0);

	// Loop through each bottle in the queue
	foreach ($q as $i => $bottle_size) {

		// We then find which queue is the "emptiest", i.e., what is the minimum item in the array
		// We use this function instead of min($tapTimes) because we want to find the INDEX of the minimum, not just the VALUE
		$minI = min_index($tapTimes);

		// By the time we get to this point we have found $minI which is the index of the lowest value in $tapTimes
		// i.e. if $tapTimes = [4, 7, 3, 9, 11] then $minI will be 2 and $minTap will be 3 (but we don't care about $minTap anymore)
		// This tells us that this person walks up to tap number 2 (assuming the first tap is tap number 0)

		// Set $flow to $tapFlows[$minI]
		$flow = $tapFlows[$minI];

		// bottle size divided by flow
		$timeSpentFillingBottle = ceil($bottle_size / $flow);

		// We add the amount of time to $tapTimes that the person is "using" the tap, to signify that this tap is busy until that point in time.
		// There are two parts to this:
		
		// PART 1: Adding on the time to walk to the tap
		if ($i >= count($tapFlows)) { // Check if the person is not among the initial people who don't need to walk
			$tapTimes[$minI] += $walkingTime;
		}
		
		// PART 2: Adding on the actual time the tap is being used to fill up the bottle
		$tapTimes[$minI] += $timeSpentFillingBottle;


	}

	// By the time we get here, we know the amount of time each tap has spent being used, so we just have to find the max value

	return max($tapTimes);

}

$queueExample = array(400, 750, 1000);
$walkTimeExample = 5;
$flowRatesExample = [50, 200];

echo '-----';
echo "\n";
echo calculateTime($queueExample, $flowRatesExample, $walkTimeExample);
echo "\n";
echo '-----';

?>


<!-- 
Changes made:
1. Corrected the function name from min_idnex to min_index and removed the unnecessary  character.
2. Corrected the variable name from $walkingTmie to $walkingTime.
3. Added conditionals to set default values for $q, $tapFlows, and $walkingTime if they are null.
4. Changed the function call calculateTime($queueExample, $flowRatesXample, 0); to calculateTime($queueExample, $flowRatesExample, $walkTimeExample); to use the correct variable names.
5. Added comments to explain the code logic and variables.
6. Fixed a typo in the comment in the loop explaining the index and value of $tapTimes.

-->

<!-- Bonus challenge:
Increasing the flow rate of at least one tap can lead to a longer total total time, because Increasing the flow rate of a tap can finish filling bottles faster but if other taps are still occupied with larger bottle sizes, those people might have to wait longer, offsetting the gains made by the faster tap.
-->
