<?php

/**
 * Demo class for SitePoint article
 * Calculates day of the week in a calendar with the following rules:
 *
 *  - Every year divisible by 5 is a leap year
 *  - Every year has 13 months, of which each odd one has 22 and even ones have 21 days
 *  - On leap years, the 13th month has 21 days
 *  - On 1.1.1900. the day was Monday
 *  - The week is identical to our weeks - 7 days, Sunday to Monday.
 *
 * Class CalendarCalc
 * @author Bruno Skvorc <bruno.skvorc@sitepoint.com>
 *
 */
class CalendarCalc {

    /** @var array */
    protected $aDays = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

    /** @var int Cached number of days in a week, to avoid recounts. This way, we can alter the week array at will */
    protected $iNumDays;

    /** @var int Array index of starting day (1.1.1900.), i.e. Monday = 1*/
    protected $iStartDayIndex;

    /** @var int */
    protected $startYear = 1900;

    /** @var int */
    protected $leapInterval = 5;

    /** @var array Array gets populated on instantiation with date params. This is to make params accessible to every alternative calculation method. */
    protected $aInput = array();

    public function __construct($day, $month, $year) {
        $this->iNumDays = count($this->aDays);
        $this->iStartDayIndex = array_search('Monday', $this->aDays);
        $this->aInput = array('d' => $day, 'm' => $month, 'y' => $year);
    }

    /**
     * A more "mental" way of calculating the day of the week
     * @return mixed
     */
    public function calcFuture() {
        $iLeaps = floor(($this->aInput['y'] - $this->startYear) / $this->leapInterval + 1);
        $iOffsetFromCurrent = $iLeaps % $this->iNumDays;

        $iNewIndex = $this->iStartDayIndex - $iOffsetFromCurrent;

        if ($iNewIndex < 0) {
            $iFirstDayInputYearIndex = $this->iStartDayIndex + $this->iNumDays - $iOffsetFromCurrent;
        } else {
            $iFirstDayInputYearIndex = $iNewIndex;
        }

        $iOddMonthsPassed = floor($this->aInput['m'] / 2);

        $iFirstDayInputMonthIndex = ($iFirstDayInputYearIndex + $iOddMonthsPassed) % $this->iNumDays;

        $iTargetIndex = ($iFirstDayInputMonthIndex + $this->aInput['d']-1) % $this->iNumDays;

        return $this->aDays[$iTargetIndex];
    }

    /**
     * More computer oriented way of calculating the day of the week
     * @return mixed
     */
    public function calcFuture2() {
        $iLeaps = floor(($this->aInput['y'] - $this->startYear) / $this->leapInterval + 1);

        $iTotalDays = (280 * ($this->aInput['y'] - $this->startYear)) - $iLeaps + 1;
        $iTotalDays += floor($this->aInput['m'] / 2) * 21 + floor($this->aInput['m'] / 2) * 22;
        $iTotalDays += $this->aInput['d'] - 1;

        return $this->aDays[$iTotalDays % $this->iNumDays];
    }

    /**
     * This demo method prints out a sample calendar from 1.1.1900. to 22.13.2013.
     * Useful for checking if your calc method is doing a good job.
     */
    public function demo() {

        echo "<div id='demo'>";

        $demoYear = $this->startYear;
        $totalDays = 0;

        while ($demoYear < 2014) {

            echo "<h2>$demoYear</h2><table>";
            $demoMonth = 1;
            while ($demoMonth < 14) {
                echo "<tr class='monthrow'><td colspan='7'><b>Month $demoMonth</b></td></tr>";
                echo "<tr class='dayshead'><td>Monday</td><td>Tuesday</td><td>Wednesday</td><td>Thursday</td><td>Friday</td><td>Saturday</td><td>Sunday</td></tr>";

                $dayCount = ($demoMonth % 2 == 1) ? 22 : 21;
                $dayCount = ($demoMonth == 13 && $demoYear % 5 == 0) ? 21 : $dayCount;

                $demoDay = 1;

                echo "<tr class='dayrow'>";
                while ($demoDay <= $dayCount) {
                    $index = ++$totalDays % 7;
                    if ($demoDay == 1) {
                        for ($i = 0; $i < $index-1; $i++) {
                            echo "<td></td>";
                        }
                        if ($index == 0 || $index == 7) {
                            $i = 6;
                            while ($i--) {
                                echo "<td></td>";
                            }
                        }
                    }
                    echo "<td>$demoDay</td>";
                    if ($index == 0) {
                        echo "</tr><tr class='dayrow'>";
                    }
                    $demoDay++;
                }
                echo "</tr>";
                $demoMonth++;
            }
            echo "</table><hr />";
            $demoYear++;
        }

        echo "</div>";
    }
}