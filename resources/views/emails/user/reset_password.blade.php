<html>
<table style="width: 600px; margin: 0 auto; font-family: Arial">
    <tr>
        <td>
            <p>Hi {{ $name }},</p>
        </td>
    </tr>
    <tr>
        <td>
            <p>You recently requested to reset your password for your [Product Name] account. Use the button below to reset it. This
                password reset is only valid for the next 24 hours.</p>
        </td>
    </tr>
    <tr>
        <td align="center">
            <a style="background-color: #22BC66;border-top: 10px solid #22BC66;border-right: 18px solid #22BC66;border-bottom: 10px solid #22BC66;border-left: 18px solid #22BC66;color: #FFF;text-decoration: none;"
               href="{!! action('User\PasswordController@getResetPassword', $token) !!}">Reset your password</a>
        </td>
    </tr>
    <tr>
        <td>
            Thanks,
            Flare Team
        </td>
    </tr>
</table>
</html>
