***The challange is completed with two languages. The codes are given in the repo.***

### Challage Overview
We have a requirement to create a function which calculates the total time required for a queue
of persons to fill up their water bottles given an n number of taps available to use.
The function should take three parameters:
1. An array of integers representing the queue of people in line, with the integers
representing the size of their bottle in millilitres.
2. An array of integers representing the available taps, with the integer representing the
filling rate in millilitres per second.
3. An integer representing the time it would take for each person in the queue to walk the
tap and fill their bottle, which should be added to the total time it took the person to fill
their bottle.

We must assume that as soon as one tap is free, the next person in the queue starts using that
tap and that they cannot move to a different tap once they start filling their bottle.
So for example, if we have a queue of [1000], a tap availability of [100] and a walking time of 2,
the output of the function should be 12, as it would take 10 seconds to fill up 1000 ml at 100
ml/s, and 2 seconds to walk to the tap.

### Requirement
You will need to review the code written for the above function. There are two variants of the
code: one written in PHP and one in JavaScript.
You may choose to review either or both, however note that there should be no major difference
between the variants, other than the syntax.
Given the inputs in the scripts of a queue of [400, 750, 1000], tap availability with rates of [50,
200] and a walking time of 5 seconds, we want the output of the function to be 18.75. In the
process of reviewing and fixing the code, we expect you to also look for:
- Whether the code behaves as expected;
- The naming convention is consistent;
- The comments are not overexplaining;
- The comments are not too vague or just reiterating what the code is doing without adding to it;

### Bonus Points
- By assuming the initial people in the queue do not have to walk to the tap in order to fill
their bottle, can you modify the function so that the output becomes 13.75 from 18.75
without changing the input?
- Is it possible for the function to output a larger number (e.g., it takes longer to fill all the
bottles) if you increase the flow rate of at least one of the taps (e.g., it takes less time to
fill a bottle). If yes, find an example. If no, prove it.
