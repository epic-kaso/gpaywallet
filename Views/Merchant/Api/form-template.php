<form method="post" action="{{ $action }}">
        <input type="hidden" name="wallet_app_id" value="{{ $wallet_app_id }}">
        <input type="hidden" name="wallet_transaction_type" value="{{ $wallet_transaction_type }}">
        <input type="hidden" name="wallet_transaction_name" value="{{ $wallet_transaction_name }}"/>
        <input type="hidden" name="wallet_transaction_amount" value="{{ $wallet_transaction_amount }}"/>
        <input type="hidden" name="wallet_user_token" value=""/>
        <input type="hidden" name="wallet_user_email" value=""/>
        <input type="hidden" name="wallet_success_url" value=""/>
        <input type="hidden" name="wallet_failure_url" value=""/>
        <input type="submit" value="{{ $button_text }}" />
</form>