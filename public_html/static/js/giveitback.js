/*jslint browser:true */
/*global $, alert*/

(function () {
    'use strict';

    function calc_pa(year, salary) {
        var pa = (year === 2014) ? 10000 : 10600,
            reduction;
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
        return year === 2014 ? 31865 : 31785;
    }

    function calc_t40(year) {
        return year === 2014 ? 118135 : 118215;
    }

    function calc_tax(year, salary) {
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
        return calc_tax(2014, salary) - calc_tax(2015, salary);
    }

    function calc_ni_pa(year) {
        return year === 2014 ? 7956 : 8060;
    }

    function calc_ni_t12(year) {
        return year === 2014 ? 33904 : 34320;
    }

    function calc_ni(year, salary) {
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
        return calc_ni(2014, salary) - calc_ni(2015, salary);
    }

    function calc_gain(salary) {
        var tax_gain = calc_tax_gain(salary),
            ni_gain = calc_ni_gain(salary);
        return (tax_gain + ni_gain);
    }

    function submitForm() {
        var salary = $("#salary"),
            salary_amount = salary.val(),
            period = $('select#period').val(),
            bonus_value,
            monthly_value;
        if (salary_amount === "") {
            salary.focus();
        } else if (salary.checkValidity() === true) {
            if (period === "monthly") {
                salary_amount *= 12;
            }

            bonus_value = calc_gain(salary_amount).toFixed(2);
            $("#bonus_value").html(bonus_value);

            if (bonus_value > 0) {
                monthly_value = (bonus_value / 12).toFixed(2);

                $("#id_amount").val(bonus_value);
                $("#id_pledge_amount_label").addClass("active");
                $("#id_suggestion").html("Why not give that money back to those who are losing out? It's £" + monthly_value + " per month.");
            } else {
                $("#id_suggestion").html("You're actually not getting any additional tax breaks this year of the sort we're considering. Why not donate to a worthwhile cause anyway?");
            }

            $("#hidden-stuff").css("display", "block");

            $('html, body').stop().animate({
                scrollTop: $("#hidden-stuff").offset().top
            }, 900, 'swing');
        }
        return false;
    }

    function donateLink() {
        $('html, body').stop().animate({
            scrollTop: $("#id_social_buttons").offset().top
        }, 'fast');
        return true;
    }

}());
