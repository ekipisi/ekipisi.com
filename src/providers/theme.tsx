'use client';

import { ThemeProvider } from 'next-themes';
import { Analytics } from '@vercel/analytics/react';
import { SpeedInsights } from '@vercel/speed-insights/next';

export default function Theme({ children }: { children: React.ReactNode }) {
  return (
    <ThemeProvider
      defaultTheme="dark"
      attribute="class"
      disableTransitionOnChange
    >
      {children}
      <Analytics />
      <SpeedInsights />
    </ThemeProvider>
  );
}
