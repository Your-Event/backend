import * as React from "react";

type ButtonProps = React.ButtonHTMLAttributes<HTMLButtonElement> & {
  isLoading?: boolean;
};

const Button = ({ isLoading, className, children, disabled, ...props }: ButtonProps) => {
  return (
    <button
      className={`flex h-11 w-full cursor-pointer items-center justify-center gap-2 rounded-md bg-black text-sm font-semibold uppercase tracking-wide text-white transition hover:bg-[#1a1a1a] disabled:cursor-not-allowed disabled:opacity-60 ${className ?? ""}`}
      disabled={disabled || isLoading}
      {...props}
    >
      {isLoading ? <span className="h-4 w-4 animate-spin rounded-full border-2 border-white/40 border-t-white" /> : null}
      {children}
    </button>
  );
};

export default Button;
