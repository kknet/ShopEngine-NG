<h1>Пригласить друга</h1>
<div class="invite-body">
    <form method="post" action="">
        <div class="invite_block">
            <?php if($error) { ?>
                <div class="errors">
                    <ul>
                        <li>
                            Произошла неизвестная ошибка. Попробуйте, пожалуйста, позже.
                        </li>
                    </ul>
                </div>
            <?php } ?>
            <?php if(Request::GetSession('error_success_email')) { ?>
                <div class="form-success">
                    <ul>
                        <li>
                            <?=Request::GetSession('error_success_email')?>
                        </li>
                    </ul>
                </div>
            <?php } ?>
            <?php if(Request::GetSession('error_email')) { ?>
                <div class="errors">
                    <ul>
                        <li>
                            <?= Request::GetSession('error_email') ?>
                        </li>
                    </ul>
                </div>
            <?php } ?>
            <ul>
                <li>
                    <label for="invite_email">E-Mail пользователя</label>
                    <input value="<?=Request::GetSession('invite_email')?>" id="invite_email" type="text" name="invite_email" placeholder="Email пользователя" />
                </li>
                <li>
                    <label for="invite_text">Сообщение пользователю</label>
                    <textarea id="invite_text" name="invite_text"><?=Request::GetSession('invite_text')?></textarea>
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
