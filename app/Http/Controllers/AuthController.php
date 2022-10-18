<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AdminRole;
use App\Models\AccessibleTab;
use App\Models\UserRole;
use App\Models\FundFieldGroup;
use App\Models\FundField;
use App\Models\AssetField;
use App\Models\AssetFieldGroup;
use Validator;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
    */
    public function register(Request $request)
    {
        $request->validate([
            'firstName' => 'string',
            'lastName' => 'string',
            'email'=>'required|string|unique:users',
            'password'=>'required|string',
            'c_password' => 'required|same:password'
        ]);

        $user = new User([
            'first_name'  => $request->firstName,
            'last_name'  => $request->lastName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'admin_role' => AdminRole::GENERAL,
            'email_verified_at' => now()
        ]);

        if($user->save()){
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;
            
            $defaultAccessibleTabs = AccessibleTab::getDefaults();
            $defaultUserRoles = UserRole::getDefaults();
            $defaultFundFieldGroups = FundFieldGroup::getDefaults();
            $defaultAssetFieldGroups = AssetFieldGroup::getDefaults();

            foreach($defaultAccessibleTabs as $defaultAccessibleTab) {
                $user->accessibleTabs()->attach($defaultAccessibleTab->id);
            }

            foreach($defaultUserRoles as $defaultUserRole) {
                $user->userRoles()->attach($defaultUserRole->id);
            }

            foreach($defaultFundFieldGroups as $defaultFundFieldGroup) {
                $userFundFieldGroup = [
                    "group_name" => $defaultFundFieldGroup->group_name,
                    "slug" => $defaultFundFieldGroup->slug,
                    "user_id" => $user->id,
                    "type" => 2
                ];
                $newFundFieldGroup = FundFieldGroup::create($userFundFieldGroup);

                $fundFields = $defaultFundFieldGroup->fundFields()->get();
                foreach($fundFields as $fundField) {
                    $newFundField = [
                        "group_id" => $newFundFieldGroup->id,
                        "name" => $fundField->name,
                        "slug" => $fundField->slug,
                        "field_type_id" => $fundField->field_type_id,
                        "isVisible" => $fundField->isVisible,
                        'isRequired' => $fundField->isRequired
                    ];
                    FundField::create($newFundField);
                }
            }

            foreach($defaultAssetFieldGroups as $defaultAssetFieldGroup) {
                $userAssetFieldGroup = [
                    "group_name" => $defaultAssetFieldGroup->group_name,
                    "slug" => $defaultAssetFieldGroup->slug,
                    "user_id" => $user->id,
                    "type" => 2
                ];
                $newAssetFieldGroup = AssetFieldGroup::create($userAssetFieldGroup);

                $assetFields = $defaultAssetFieldGroup->assetFields()->get();
                foreach($assetFields as $assetField) {
                    $newAssetField = [
                        "group_id" => $newAssetFieldGroup->id,
                        "name" => $assetField->name,
                        "slug" => $assetField->slug,
                        "field_type_id" => $assetField->field_type_id,
                        "isVisible" => $assetField->isVisible,
                        'isRequired' => $assetField->isRequired
                    ];
                    AssetField::create($newAssetField);
                }
            }

            Auth::login($user);
            
            return response()->json([
                'accessToken' => $token,
                'token_type' => 'Bearer',
                "userData" => [
                    'email' => $request->email,
                    'firstName'  => $request->firstName,
                    'lastName' => $request->lastName,
                    'role' => $user->userRoles(),
                    'accessibleTabs' => $user->accessibleTabs(),
                    'accessibleFunds' => $user->accessibleFunds(),
                    'accessibleAssets' => $user->accessibleAssets(),
                    'ability' => [
                        [
                            'action' => 'manage',
                            'subject' => 'Auth'
                        ]
                    ]
                ]
            ],201);
        }
        else{
            return response()->json(['error'=>'Provide proper details']);
        }
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
    */

    public function login(Request $request)
    {
        $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
        'remember_me' => 'boolean'
        ]);

        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials))
        {
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
            'accessToken' =>$token,
            'token_type' => 'Bearer',
            "userData" => [
                'email' => $user->email,
                'firstName'  => $user->first_name,
                'lastName' => $user->last_name,
                'role' => $user->userRoles(),
                'accessibleTabs' => $user->accessibleTabs(),
                'accessibleFunds' => $user->accessibleFunds(),
                'accessibleAssets' => $user->accessibleAssets(),
                'ability' => [
                    [
                        'action' => 'manage',
                        'subject' => 'Auth'
                    ]
                ]
            ]
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
    */
    public function user(Request $request)
    {
        return response()->json([
            'userData' => $request->user()
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
    */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);

    }
}
