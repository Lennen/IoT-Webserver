    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-center" href="./">
            <img src="./assets/techfeya.jpg" style="height:30px;" /> 
        </a>

        <ul class="navbar-nav px-3">
            <li class="text-nowrap"><table><tr>
                <td style="padding-right:20px; padding-left:20px"><a class="nav-link" href="lk.php"><?php echo $userdata['user_login']; ?></a></td>

                <?php if($userdata['user_login']): ?><td style="padding-right:20px"><a class="nav-link" href="logout.php">Выйти</a></td>
                <?php else: ?><td style="padding-right:20px"><a class="nav-link" href="login.php">Войти</a></td><?php endif; ?>
                </tr></table>
            </li>
        </ul>
    </nav>