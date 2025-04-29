"use client";

import { Globe, Loader } from 'lucide-react';
import { useLocale, useTranslations } from 'next-intl';
import Image from 'next/image';
import { useEffect, useState } from 'react';

import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { usePathname, useRouter } from '@/i18n/navigation';
import { Button } from '@components/ui/button';
import { locales } from '@constants/languages';

export function LocaleSwitcher() {
  const [isOpen, setIsOpen] = useState<boolean>(false);
  const [mounted, setMounted] = useState<boolean>(false);
  const router = useRouter();
  const pathname = usePathname();
  const locale = useLocale();
  const t = useTranslations();

  useEffect(() => {
    setMounted(true);
  }, []);

  const handleChange = (value: string) => {
    router.push(pathname, { locale: value });
    router.refresh();
  };

  if (!mounted) {
    return (
      <Button size="icon" variant="ghost">
        <Loader className="size-5 animate-spin text-zinc-400" />
        <span className="sr-only">{t("Shared.Loading")}</span>
      </Button>
    );
  }

  return (
    <Popover open={isOpen} onOpenChange={setIsOpen}>
      <PopoverTrigger onClick={() => setIsOpen((prev) => !prev)} asChild>
        <Button
          size="icon"
          variant="ghost"
          className="size-6 text-gray-500 hover:text-gray-700 cursor-pointer"
        >
          <Globe className="h-5 w-5" />
        </Button>
      </PopoverTrigger>

      <PopoverContent
        className="w-25 p-1"
        align="start"
        onBlur={() => setIsOpen(false)}
      >
        {locales.map((lang, index) => (
          <div
            key={index}
            className={`flex flex-row items-center p-0.5 hover:bg-accent cursor-pointer rounded-md mb-1 ${
              locale == lang.id ? "selected" : ""
            }`}
            onClick={() => handleChange(lang.id)}
          >
            <div className="mx-2">
              <Image
                width={16}
                height={16}
                src={lang.flag}
                alt={lang.name}
                className="flex-none w-4"
              />
            </div>
            <div className="text-xs font-medium">{lang.name}</div>
          </div>
        ))}
      </PopoverContent>
    </Popover>
  );
}
