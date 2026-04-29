import type { ReactNode } from "react";
import { Dancing_Script } from "next/font/google";

const scriptFont = Dancing_Script({
  subsets: ["latin"],
  weight: ["400", "500", "700"],
});

type AuthShellProps = {
  title: string;
  subtitle: string;
  children: ReactNode;
};

const AuthShell = ({ title, subtitle, children }: AuthShellProps) => {
  return (
    <div className="min-h-screen bg-[#d9d9d9] text-[#1d1d1d]">
      <div className="mx-auto flex min-h-screen max-w-3xl flex-col px-6 pb-10 pt-6">
        <div className="h-12 w-full rounded-full bg-[#6b0f17] shadow-md" />
        <main className="flex flex-1 flex-col items-center justify-start pt-10 text-center">
          <h1 className={`${scriptFont.className} text-5xl text-[#2b2b2b]`}>
            Your Event
          </h1>
          <p className="mt-2 max-w-md text-xs leading-relaxed text-[#5b5b5b]">
            Organize your event, save time, and get the opportunity to choose
            the best professional to make your celebration unforgettable.
          </p>
          <div className="mt-10 w-full max-w-md space-y-6 rounded-2xl bg-[#d9d9d9]">
            <div className="space-y-2">
              <h1 className="text-xl font-semibold tracking-tight text-[#2b2b2b]">
                {title}
              </h1>
              <p className="text-sm text-[#4b4b4b]">{subtitle}</p>
            </div>
            {children}
          </div>
        </main>
        <footer className="mt-12 border-t border-black/10 pt-6 text-sm text-[#2b2b2b]">
          <div className="flex flex-col items-center justify-between gap-6 text-center sm:flex-row sm:text-left">
            <div>
              <p className="font-semibold">Site name</p>
              <div className="mt-3 flex items-center justify-center gap-3 text-[#3b3b3b] sm:justify-start">
                <span className="h-6 w-6 rounded-full border border-[#3b3b3b]" />
                <span className="h-6 w-6 rounded-full border border-[#3b3b3b]" />
                <span className="h-6 w-6 rounded-full border border-[#3b3b3b]" />
                <span className="h-6 w-6 rounded-full border border-[#3b3b3b]" />
              </div>
            </div>
            <div className="grid grid-cols-3 gap-6 text-xs text-[#4b4b4b]">
              <div className="space-y-2">
                <p className="font-semibold uppercase tracking-wide">Topic</p>
                <p>Page</p>
                <p>Page</p>
                <p>Page</p>
              </div>
              <div className="space-y-2">
                <p className="font-semibold uppercase tracking-wide">Topic</p>
                <p>Page</p>
                <p>Page</p>
                <p>Page</p>
              </div>
              <div className="space-y-2">
                <p className="font-semibold uppercase tracking-wide">Topic</p>
                <p>Page</p>
                <p>Page</p>
                <p>Page</p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
  );
};

export default AuthShell;
