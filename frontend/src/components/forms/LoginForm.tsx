"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";
import Link from "next/link";

import { apiFetch, isApiError } from "@/lib/api/client";
import { loginRequestSchema, loginResponseSchema } from "@/lib/api/schemas";
import type { LoginRequest, LoginResponse } from "@/lib/api/types";
import { getRedirectPathForRole } from "@/lib/auth/guards";
import { getSessionUser, setAuthToken } from "@/lib/auth/session";
import Button from "@/components/ui/Button";
import FormError from "@/components/ui/FormError";
import Input from "@/components/ui/Input";

const LoginForm = () => {
  const router = useRouter();
  const [formError, setFormError] = useState<string | null>(null);
  const {
    register,
    handleSubmit,
    setError,
    formState: { errors, isSubmitting },
  } = useForm<LoginRequest>({
    resolver: zodResolver(loginRequestSchema),
    defaultValues: {
      email: "",
      password: "",
    },
  });

  const onSubmit = async (values: LoginRequest) => {
    setFormError(null);
    try {
      const response = await apiFetch<LoginResponse>("/auth/login", {
        method: "POST",
        body: values,
      });
      const data = loginResponseSchema.parse(response);

      if (data.token) {
        setAuthToken(data.token);
      }

      const user = await getSessionUser();
      router.push(getRedirectPathForRole(user.role));
    } catch (error) {
      if (isApiError(error)) {
        if (error.fieldErrors) {
          Object.entries(error.fieldErrors).forEach(([field, messages]) => {
            const message = messages?.[0] ?? "Invalid value.";
            if (field === "email" || field === "password") {
              setError(field, { type: "server", message });
            }
          });
        }
        setFormError(error.message);
        return;
      }

      setFormError("Unable to sign in. Please try again.");
    }
  };

  return (
    <form className="flex w-full flex-col gap-4" onSubmit={handleSubmit(onSubmit)}>
      <FormError message={formError} />
      <Input
        label="Email address"
        type="email"
        autoComplete="email"
        error={errors.email?.message}
        {...register("email")}
      />
      <Input
        label="Password"
        type="password"
        autoComplete="current-password"
        error={errors.password?.message}
        {...register("password")}
      />
      <Button type="submit" isLoading={isSubmitting}>
        {isSubmitting ? "Signing in" : "Submit"}
      </Button>
      <p className="text-center text-xs text-[#4b4b4b]">
        Don&apos;t have an account?{" "}
        <Link className="font-semibold text-[#2b2b2b] underline" href="/register">
          Create one
        </Link>
      </p>
    </form>
  );
};

export default LoginForm;
