<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial; background:#f5f5f5; padding:20px;">

<div style="max-width:600px; background:#ffffff; padding:25px; margin:auto; border-radius:8px;">

    <h2>Hello {{ $user->name }},</h2>

    @if($status == 'approved')
        <p style="color:green;">
            🎉 Congratulations! Your account has been <strong>Approved</strong>.
        </p>
        <p>You can now login and access your dashboard.</p>

    @elseif($status == 'rejected')
        <p style="color:red;">
            ❌ Your account has been <strong>Rejected</strong>.
        </p>
        <p>Please check your submitted documents and resubmit again.</p>

    @elseif($status == 'submitted')
        <p>
            📩 Your documents have been successfully <strong>Submitted</strong>.
        </p>
        <p>Please wait for admin approval.</p>

    @elseif($status == 'verified')
        <p>
            ✅ Your documents are <strong>Verified</strong>.
            Final approval is pending.
        </p>

    @elseif($status == 'active')
        <p style="color:green;">
            🚀 Your account is now <strong>Active</strong>.
        </p>

    @elseif($status == 'suspended')
        <p style="color:orange;">
            ⚠️ Your account has been <strong>Suspended</strong>.
            Please contact support.
        </p>

    @elseif($status == 'expired')
        <p style="color:red;">
            ⏳ Your account has <strong>Expired</strong>.
            Please renew to continue.
        </p>

    @elseif($status == 'draft')
        <p>
            📝 Your profile is currently saved as <strong>Draft</strong>.
            Please complete and submit it.
        </p>
    @endif

    <br>
    <p>Thank you,<br>
    Support Team</p>

</div>

</body>
</html>