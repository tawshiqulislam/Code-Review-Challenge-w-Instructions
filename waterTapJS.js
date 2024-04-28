// Define a function that we'll need to use later
// This function works exactly the same way as the "min" function, except it returns the INDEX of the value which is minimum, not the VALUE of the value which is minimum
function min_index(array) {
    let min_index = null;
    let minValue = null;
    array.forEach((value, i) => {
        if (minValue === null || value < minValue) {
            min_index = i;
            minValue = value;
        }
    });
    return min_index;
}

// Define our actual important function
function calculateTime(q, tapFlows, walkingTime) {
    // Defaulting the values in case omitted
    if(q == null) {
        q = [400, 750, 1000];
    }

    if(tapFlows == null) {
        tapFlows = [100, 100];
    }

    if(walkingTime == null) {
        walkingTime = 0;
    }

    // tapTimes is the total time people have spent at each tap as we move down the queue.
    // Before the loop, this is initialised as [0, 0, 0, ....., 0] with one zero for each tap
    let tapTimes = Array(tapFlows.length).fill(0);

    // Loop through each bottle in the queue
    q.forEach((bottle_size, i) => {
		
        // We then find which queue is the "emptiest", ie what is the minimum item in the array
        // We use this function instead of Math.min(...tapTimes) because we want to find the INDEX of the minimum, not just the VALUE
        let minI = min_index(tapTimes);

        // By the time we get to this point we have found minI which is the index of the lowest value in tapTimes
        // i.e. if tapTimes = [4, 7, 3, 9, 11] then minI will be 2 and minTap will be 3 (but we don't care about minTap anymore)
        // This tells us that this person walks up to tap number minI (assuming the first tap is tap number 0)

        // Set flow to tapFlows[minI]
        let flow = tapFlows[minI];

        // bottle size divided by flow
        let timeSpentFillingBottle = Math.ceil(bottle_size / flow);

        // We add the amount of time to tapTimes that the person is "using" the tap, to signify that this tap is busy until that point in time.
        // There are two parts to this:

        // PART 1: Adding on the time to walk to the tap
        if (i >= tapFlows.length) { // Check if the person is not among the initial people who don't need to walk
            tapTimes[minI] += walkingTime;
		}

        // PART 2: Adding on the actual time the tap is being used to fill up the bottle
        tapTimes[minI] += timeSpentFillingBottle;
    });

    // By the time we get here, we know the amount of time each tap has spent being used, so we just have to find the max value
    return Math.max(...tapTimes);
}

let queueExample = [400, 750, 1000];
let walkTimeExample = 5;
let flowRatesExample = [50, 200];

console.log('-----');
console.log(calculateTime(queueExample, flowRatesExample, walkTimeExample));
console.log('-----');




// Changes made:
// 1. Corrected the function name from min_idnex to min_index and removed the unnecessary  character.
// 2. Corrected the variable name from $walkingTmie to $walkingTime.
// 3. Added conditionals to set default values for q, tapFlows, and walkingTime if they are null.
// 4. Changed the function call calculateTime(queueExample, flowRatesXample, 0); to calculateTime(queueExample, flowRatesExample, walkTimeExample); to use the correct variable names.
// 5. Corrected the comment regarding variable names tapTimes and minI.
// 6. Fixed indentation for clarity.


// Bonus challenge:
// Increasing the flow rate of at least one tap can lead to a longer total total time, because Increasing the flow rate of a tap can finish filling bottles faster but if other taps are still occupied with larger bottle sizes, those people might have to wait longer, offsetting the gains made by the faster tap.