/*jslint browser:true */
/*global $, alert*/

function calc_pa(year, salary) {
    "use strict";
    var pa = 10600,
        reduction;
    if (year === 2014) {
        pa = 10000;
    }
    if (salary > 100000) {
        reduction = (salary - 100000) / 2;
        reduction -= reduction % 1;
        pa -= reduction;
        if (pa < 0) {
            pa = 0;
        }
    }
    return pa;
}

function calc_t20(year) {
    "use strict";
    if (year === 2014) {
        return 31865;
    }
    return 31785;
}

function calc_t40(year) {
    "use strict";
    if (year === 2014) {
        return 118135;
    }
    return 118215;
}

function calc_tax(year, salary) {
    "use strict";
    var pa = calc_pa(year, salary),
        t20 = calc_t20(year) + pa,
        t40 = calc_t40(year) + t20,
        tax = 0,
        extra = 0;

    if (salary > t40) {
        extra = salary - t40;
        tax += extra * 0.45;
        salary -= extra;
    }
    if (salary > t20) {
        extra = salary - t20;
        tax += extra * 0.4;
        salary -= extra;
    }
    if (salary > pa) {
        extra = salary - pa;
        tax += extra * 0.2;
    }

    return tax;
}

function calc_tax_gain(salary) {
    "use strict";
    return calc_tax(2014, salary) - calc_tax(2015, salary);
}

function calc_ni_pa(year) {
    "use strict";
    if (year === 2014) {
        return 7956;
    }
    return 8060;
}

function calc_ni_t12(year) {
    "use strict";
    if (year === 2014) {
        return 33904;
    }
    return 34320;
}

function calc_ni(year, salary) {
    "use strict";
    var pa = calc_ni_pa(year),
        t12 = calc_ni_t12(year) + pa,
        ni = 0,
        extra = 0;

    if (salary > t12) {
        extra = salary - t12;
        ni += extra * 0.02;
        salary -= extra;
    }
    if (salary > pa) {
        extra = salary - pa;
        ni += extra * 0.12;
    }

    return ni;
}

function calc_ni_gain(salary) {
    "use strict";
    return calc_ni(2014, salary) - calc_ni(2015, salary);
}

function calc_gain(salary) {
    "use strict";
    var tax_gain = calc_tax_gain(salary),
        ni_gain = calc_ni_gain(salary);
    return (tax_gain + ni_gain);
}

function submitForm() {
    "use strict";
    var salary = document.getElementById("salary"),
        salary_amount,
        period_select,
        period,
        bonus_value,
        monthly_value,
        $target;
    if (salary.value === "") {
        salary.focus();
    } else if (salary.checkValidity() === true) {
        salary_amount = salary.value;
        period_select = document.getElementById("period");
        period = period_select.options[period_select.selectedIndex].value;
        if (period === "monthly") {
            salary_amount *= 12;
        }

        bonus_value = calc_gain(salary_amount).toFixed(2);
        document.getElementById("bonus_value").innerHTML = bonus_value;

        if (bonus_value > 0) {
            monthly_value = (bonus_value / 12).toFixed(2);

            document.getElementById("id_amount").value = bonus_value;
            document.getElementById("id_pledge_amount_label").className += " active";
            document.getElementById("id_suggestion").innerHTML = "Why not give that money back to those who are losing out? It's £" + monthly_value + " per month.";
        } else {
            document.getElementById("id_suggestion").innerHTML = "You're actually not getting any additional tax breaks this year of the sort we're considering. Why not donate to a worthwhile cause anyway?";
        }

        document.getElementById("hidden-stuff").style.display = "block";

        $target = $(document.getElementById("hidden-stuff"));

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing');
    }
    return false;
}

function donateLink() {
    "use strict";
    document.getElementById("id_social_buttons").scrollIntoView();
    return true;
}
