<div class="invite-body">
    <form method="post" action="">
        <div class="invite_block">
            <ul>
                <li>
                    <label for="invite_email">E-Mail пользователя</label>
                    <input id="invite_email" type="text" name="invite_email" placeholder="Email пользователя" />
                </li>
                <li>
                    <label for="invite_text">Сообщение пользователю</label>
                    <textarea id="invite_text" name="invite_text"></textarea>
                </li>
                <li>
                    <input type="submit" class="btn" name="invite_submit" value="Отправить приглашение" />
                </li>
            </ul>
        </div>
        <input type="hidden" name="csrf" value="<?=ShopEngine::Help()->generateToken()?>" />
        <input type="hidden" name="invite" value="1" />               
    </form>
</div>
