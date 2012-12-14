#Timer
Timer allows for the simple timing and debugging of overlapping points in PHP script.

##Usage

###Basic timing
	Timer::start('foo');
	// lots of code
	Timer::stop('foo');

	// let's see how things performed
	Timer::showRuns();	

###Timing different, overlapping points
	Timer::start('foo');
	// lots of code
	Timer::start('bar');
	// more code here
	Timer::stop('foo');
	// do more things with code
	Timer::stop('bar');

	// let's see how things performed
	Timer::showRuns();
---
##Notes

The class keeps track of what has been started and what has been stopped and will let you know
if you have started a *Timer* that you have not stopped.

##To Do

* Allow for return of run data instead of echoing
* Add logging to file
* Allow for configurable reporting: start, stop, elapsed, line numbers or any mix of these in any order..