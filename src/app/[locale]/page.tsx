import { LocaleSwitcher } from '@components/header/locale-switcher';
import { ThemeSwitcher } from '@components/header/theme-switcher';

export default async function Page() {
  return (
    <div>
      Test Deneme
      <ThemeSwitcher />
      <LocaleSwitcher />
    </div>
  );
}
