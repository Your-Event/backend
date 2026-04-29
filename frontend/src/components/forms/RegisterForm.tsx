"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";
import Link from "next/link";

import { apiFetch, isApiError } from "@/lib/api/client";
import { registerRequestSchema, registerResponseSchema } from "@/lib/api/schemas";
import type { RegisterRequest, RegisterResponse } from "@/lib/api/types";
import { getRedirectPathForRole } from "@/lib/auth/guards";
import { getSessionUser, setAuthToken } from "@/lib/auth/session";
import Button from "@/components/ui/Button";
import FormError from "@/components/ui/FormError";
import Input from "@/components/ui/Input";

const RegisterForm = () => {
  const router = useRouter();
  const [formError, setFormError] = useState<string | null>(null);
  const {
    register,
    handleSubmit,
    setError,
    formState: { errors, isSubmitting },
  } = useForm<RegisterRequest>({
    resolver: zodResolver(registerRequestSchema),
    defaultValues: {
      role: "client",
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    },
  });

  const onSubmit = async (values: RegisterRequest) => {
    setFormError(null);
    try {
      const response = await apiFetch<RegisterResponse>("/auth/register", {
        method: "POST",
        body: values,
      });
      const data = registerResponseSchema.parse(response);

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
            if (
              field === "role" ||
              field === "name" ||
              field === "email" ||
              field === "password" ||
              field === "password_confirmation"
            ) {
              setError(field, { type: "server", message });
            }
          });
        }
        setFormError(error.message);
        return;
      }

      setFormError("Unable to register. Please try again.");
    }
  };

  return (
    <form className="flex w-full flex-col gap-4" onSubmit={handleSubmit(onSubmit)}>
      <FormError message={formError} />
      <fieldset className="flex w-full flex-col gap-2 text-left">
        <legend className="text-xs font-semibold uppercase tracking-wide text-[#3b3b3b]">
          Type
        </legend>
        <div className="mt-2 grid grid-cols-1 gap-3 sm:grid-cols-3 sm:gap-4">
          {[
            { value: "client", label: "Client" },
            { value: "showman", label: "Showman" },
            { value: "restaurant", label: "Company" },
          ].map((option) => (
            <label key={option.value} className="group relative flex items-center gap-2">
              <input
                type="radio"
                value={option.value}
                className="auth-toggle"
                {...register("role")}
              />
              <span className="auth-toggle-label">{option.label}</span>
            </label>
          ))}
        </div>
        {errors.role?.message ? (
          <p className="text-xs text-[#7a1f25]" role="alert">
            {errors.role?.message}
          </p>
        ) : null}
      </fieldset>
      <Input
        label="Name"
        type="text"
        autoComplete="name"
        error={errors.name?.message}
        {...register("name")}
      />
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
        autoComplete="new-password"
        error={errors.password?.message}
        {...register("password")}
      />
      <Input
        label="Password confirmed"
        type="password"
        autoComplete="new-password"
        error={errors.password_confirmation?.message}
        {...register("password_confirmation")}
      />
      <Button type="submit" isLoading={isSubmitting}>
        {isSubmitting ? "Creating account" : "Submit"}
      </Button>
      <p className="text-center text-xs text-[#4b4b4b]">
        Already have an account?{" "}
        <Link className="font-semibold text-[#2b2b2b] underline" href="/login">
          Sign in
        </Link>
      </p>
    </form>
  );
};

export default RegisterForm;
