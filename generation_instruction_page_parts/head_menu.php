<?php include '../check_login.php'; ?>

        <ul class="navbar-nav px-3">
            <li class="text-nowrap"><table><tr>
                <td style="padding-right:20px; padding-left:20px"><a class="nav-link" href="../lk.php"><?php echo $userdata['user_login']; ?></a></td>

                <?php if($userdata['user_login']): ?><td style="padding-right:20px"><a class="nav-link" href="../logout.php">Выйти</a></td>
                <?php else: ?><td style="padding-right:20px"><a class="nav-link" href="login.php">Войти</a></td><?php endif; ?>
                </tr></table>
            </li>
        </ul>
    </nav>