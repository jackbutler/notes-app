<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Flash;

use App\Http\Requests;

class UserController extends Controller
{
    /**
     * Retrieves the logged-in user and displays the "Edit Profile" view
     *
     * @return mixed
     */
    public function getMyProfile() {

        $user = \Auth::user();

        return view("profileView",[
            "user"  => $user
        ]);
    }

    /**
     * Processes an uploaded profile picture
     *
     * @return mixed
     */
    public function updateProfilePicture(Request $request) {

        // Get the logged-in user
        $user = \Auth::user();

        // Check the file has been submitted
        if($request->hasFile('profile_picture')) {

            // Validate the image
            $file = array('image' => Input::file('profile_picture'));
            $rules = array('image' => 'image|image_size:<=600',);
            $validator = Validator::make($file, $rules);

            // Invalid upload
            if ($validator->fails()) {
                return redirect('profile')->withInput()->withErrors($validator);
            }

            // Valid upload
            else {

                // Check the image uploaded successfully
                if (Input::file('profile_picture')->isValid()) {
                    $destinationPath = public_path() . '/uploads';
                    $extension = Input::file('profile_picture')->getClientOriginalExtension();

                    // Rename image to ensure its filename is unique
                    $fileName =  Input::file('profile_picture')->getClientOriginalName()."_".time(). '.' . $extension;

                    // Perform the upload
                    Input::file('profile_picture')->move($destinationPath, $fileName);

                    // Upload Successful
                    $user->profile_picture = $fileName;
                    $user->save();
                    Flash::success("Upload successful");
                } else {
                    // Uploaded file was not valid.
                    Flash::danger('Uploaded file is not valid');
                }
            }
        }
        return redirect('profile');
    }

    /**
     * Process submitted profile details
     *
     * @return mixed
     */
    public function updateProfileDetails(Request $request) {

        $user = \Auth::user();

        // Define the validation rules
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
        ];

        // Check the email address has actually changed before adding this rule. Otherwise
        // the "unique" check will fail as the email already exists
        if($request->input("email")!= $user->email) {
            $rules['email'] = 'required|email|unique:users';
        }

        // Run the validator
        $this->validate($request, $rules);

        // Update the user
        $user->first_name = $request->input("first_name");
        $user->last_name = $request->input("last_name");
        $user->email = $request->input("email");
        $user->save();

        Flash::success("Profile Updated Successfully");
        return redirect('profile');
    }
}

