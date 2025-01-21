#!/usr/bin/perl -wT
#Nathan Ngo 501090210
use strict;
use warnings;
use CGI ':standard';
use CGI::Carp qw(fatalsToBrowser);
use File::Basename;

# Define upload directory
my $upload_dir = "../upload";

# Initialize CGI object
my $query = CGI->new;

# Retrieve form values
my $safe_filename_characters = "a-zA-Z0-9_.-";
my $filename = $query->param("photo");
my $first_name = $query->param('first');
my $last_name = $query->param('last');
my $street = $query->param('street');
my $city = $query->param('city');
my $postal_code = $query->param("postalcode");
my $phone = $query->param('phonenum');
my $email = $query->param('emailad');
my $province = $query->param('province');

# Validation lengths
my $phone_length = length $phone;
my $postal_length = length $postal_code;

# Check if a file was uploaded
if ( !$filename ) { 
    print $query->header();
    print "No File was uploaded or there was an issue with your file";
    exit;
}

# Sanitize the filename
my ( $name, $path, $extension ) = fileparse( $filename, '\..*' );
$filename = $name . $extension;
$filename =~ tr/ /_/;
$filename =~ s/[^$safe_filename_characters]//g;

if ($filename =~ /^([$safe_filename_characters]+)$/) {
    $filename = $1;
} else {
    die "Filename contains invalid characters";
}

# Save the uploaded file
my $upload_filehandle = $query->upload("photo");
open( UPLOADFILE, ">$upload_dir/$filename" ) or die "Failed to save uploaded image: $!";
binmode UPLOADFILE;

while ( my $chunk = <$upload_filehandle> ) {
    print UPLOADFILE $chunk;
}
close UPLOADFILE;

# Output HTML header and style
print $query->header();

print qq(
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 20px 0;
            text-align: center;
        }
        .container {
            max-width: 600px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: left;
            font-size: 18px;
            color: black;
            margin-top: 20px;
        }
        h1 {
            text-align: center;
            color: #007ACC;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .error {
            color: #D8000C;
            background-color: #FFBABA;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        img {
            height: 300px; /* Fixed height */
            width: auto; /* Maintain aspect ratio */
            margin: 15px auto 0; /* Center image */
            display: block; /* Center image */
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        a {
            color: #007ACC;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
    <div class="container">
        <h1>Customer Registration Page</h1>
);

# Display errors if any validation fails
if ($phone_length != 10 || $phone =~ /[[:alpha:]]/) {
    print qq(
        <div class="error">
            ERROR! Your Phone Number: $phone, should be 10 numbers long and only contain numbers!
        </div>
    );
}

if ($postal_length != 7) {
    print qq(
        <div class="error">
            ERROR! Your Postal Code: $postal_code, should be 7 characters long!
        </div>
    );
}

if ($email !~ /^[a-z0-9A-Z.]+\@[a-z0-9A-Z.-]+$/) {
    print qq(
        <div class="error">
            ERROR! Your Email: $email, is not formatted correctly!
        </div>
    );
}

# If no errors, display confirmation and user details
if ($email =~ /^[a-z0-9A-Z.]+\@[a-z0-9A-Z.-]+$/ && $postal_length == 7 && $phone_length == 10 && $phone !~ /[[:alpha:]]/) {
    print qq(
        <div>
            <p>Your Form has been Successfully Submitted!</p>
            <p>
                $first_name $last_name<br>
                $street<br>
                $city, $province, $postal_code<br>
                $phone - $email
            </p>
            <img src="$upload_dir/$filename" alt="Uploaded Photo">
        </div>
    );
}

# Add a "Go back to registration page" link
print qq(
    <div class="back-link">
        <a href="/~n8ngo/lab07/lab07b.html">Go back to the registration page</a>
    </div>
</div>
);
