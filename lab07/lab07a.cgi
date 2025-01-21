#!/usr/bin/perl
#Nathan Ngo 501090210
use strict;
use warnings;
use CGI ':standard';
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);

print header;
print start_html(
    -title => 'My First Perl Program',
    -style => { 
        -code => '
            body {
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-color: #f0f4f8;
                color: #333;
            }
            h1 {
                font-size: 2.5em;
                color: #007ACC;
                text-align: center;
            }
        ' 
    }
);

print h1("This is my first Perl program");
print end_html;
