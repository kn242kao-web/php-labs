<?php
/**
 * Гостьова книга GymMaster — Варіант 11
 * @var array $comments Масив відгуків, який передається з GuestbookController
 * @var string $message Повідомлення про успіх
 * @var string $error Повідомлення про помилку
 */
?>

<div class="guestbook-page" style="max-width: 1000px; margin: 0 auto; padding: 20px;">
    <h1 style="font-size: 2.2rem; font-weight: 800; color: #111827; margin-bottom: 5px;">Відгуки клієнтів</h1>
    <p style="color: #4b5563; margin-bottom: 30px; font-size: 1.05rem;">
        Коментарі зберігаються у файлі <code>data/comments.jsonl</code> (або <code>comments.csv</code>).
    </p>

    <div class="comment-form-container" style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; margin-bottom: 40px;">
        <h2 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-top: 0; margin-bottom: 20px;">Залишити відгук про тренування</h2>

        <?php if (!empty($message)): ?>
            <div style="padding: 12px; background: #dcfce7; color: #166534; border-radius: 6px; margin-bottom: 15px; font-weight: 500;">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div style="padding: 12px; background: #fee2e2; color: #991b1b; border-radius: 6px; margin-bottom: 15px; font-weight: 500;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="index.php?route=guestbook" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">Ваше ім'я / Прізвище <span style="color: red;">*</span></label>
                <input type="text" name="name" required placeholder="Введіть ваше ім'я" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">Враження від тренування <span style="color: red;">*</span></label>
                <textarea name="comment" required rows="4" placeholder="Поділіться враженнями про тренерів, тренажери або сервіс..." style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; font-family: inherit; box-sizing: border-box; resize: vertical;"></textarea>
            </div>

            <div>
                <button type="submit" style="padding: 12px 24px; background-color: #2563eb; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 1rem; transition: background 0.2s;">
                    Додати відгук
                </button>
            </div>
        </form>
    </div>

    <h2 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 20px;">
        Всі коментарі атлетів (<?= is_array($comments) ? count($comments) : 0 ?>)
    </h2>

    <div style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 1rem;">
            <thead>
                <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                    <th style="padding: 14px 20px; font-weight: 700; color: #4b5563; text-transform: uppercase; font-size: 0.85rem; width: 20%;">Дата</th>
                    <th style="padding: 14px 20px; font-weight: 700; color: #4b5563; text-transform: uppercase; font-size: 0.85rem; width: 25%;">Ім'я атлета</th>
                    <th style="padding: 14px 20px; font-weight: 700; color: #4b5563; text-transform: uppercase; font-size: 0.85rem; width: 55%;">Текст відгуку</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($comments) && is_array($comments)): ?>
                    <?php foreach ($comments as $comment): 
                        $date = $comment['date'] ?? $comment['visit_date'] ?? $comment['created_at'] ?? date('Y-m-d H:i');
                        $name = $comment['name'] ?? $comment['athlete_name'] ?? 'Гість';
                        $text = $comment['comment'] ?? $comment['text'] ?? '';
                    ?>
                        <tr style="border-bottom: 1px solid #edf2f7;">
                            <td style="padding: 14px 20px; color: #6b7280; font-size: 0.95rem; white-space: nowrap;">
                                <?= htmlspecialchars((string)$date) ?>
                            </td>
                            <td style="padding: 14px 20px; font-weight: 600; color: #1f2937;">
                                <?= htmlspecialchars((string)$name) ?>
                            </td>
                            <td style="padding: 14px 20px; color: #4b5563; line-height: 1.5;">
                                <?= nl2br(htmlspecialchars((string)$text)) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="padding: 30px; text-align: center; color: #9ca3af; font-style: italic;">
                            Відгуків про зал ще немає. Залиште свій коментар першим!
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>