<!--
 * This file is part of the SQUADCLOUD project.
 *
 * (c) SQUADCLOUD TEAM
 *
 * This file contains the configuration settings for the application.
 * It includes database connection details, API keys, and other sensitive information.
 *
 * IMPORTANT: DO NOT MODIFY THIS FILE UNLESS YOU ARE AN AUTHORIZED DEVELOPER.
 * Changes made to this file may cause unexpected behavior in the application.
 *
 * WARNING: DO NOT SHARE THIS FILE WITH ANYONE OR UPLOAD IT TO A PUBLIC REPOSITORY.
 *
 * Website: https://squadcloud.co
 * Created: January, 2024
 * Last Updated: 15th May, 2024
 * Author: Talha Fahim <info@squadcloud.co>
 *-->
 <!-- Code Onset -->
 <table class="table">
    <thead>
        <tr>
            <th>
                Menus
            </th>
            <th>
                Access
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($userAccesses as $key => $userAccess)
        <tr>
            <td>
                {{$userAccess->submenu->submenu}}
            </td>
            <td>
                @if($userAccess->status == 1)
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input changeAccess" checked data-value="{{$userAccess->id}}" id="customSwitch{{$key}}">
                    <label class="custom-control-label" for="customSwitch{{$key}}"></label>
                </div>
                @else
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input changeAccess" data-value="{{$userAccess->id}}" id="customSwitch{{$key}}">
                    <label class="custom-control-label" for="customSwitch{{$key}}"></label>
                </div>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Code Finalize -->