import colors from 'tailwindcss/colors'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'

 

export default {
    content: ['./resources/**/*.blade.php', './vendor/filament/**/*.blade.php'],
    theme: {
        extend: {
            colors: {
                danger: colors.red,
                gray: colors.slate,
                info: colors.blue,
                primary: colors.indigo,
                success: colors.emerald,
                warning: colors.orange,

                // danger: colors.red,
                // gray: colors.slate,
                // primary: colors.blue,
                // success: colors.green,
                // warning: colors.yellow,

            //     'danger' => Color::Red,
            // 'gray' => Color::Slate,
            // 'info' => Color::Blue,
            // 'primary' => Color::Indigo,
            // 'success' => Color::Emerald,
            // 'warning' => Color::Orange,
            },
       
        },
    },
    plugins: [forms, typography],
}
