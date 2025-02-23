import FeatureItem from "@/Components/FeatureItem";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextAreaInput from "@/Components/TextAreaInput";
import TextInput from "@/Components/TextInput";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Feature, PaginatedData } from "@/types";
import { Head, useForm } from "@inertiajs/react";
import { FormEventHandler } from "react";

export default function Edit({feature}:{feature:Feature}) {

    const { data, setData,  errors, processing , put } = useForm({
        name: feature.name,
        description: feature.description,
    });

    const updateFeature: FormEventHandler = (ev) => {
        ev.preventDefault();
        console.log("Form data:", data); // Debugging
        put(route("feature.update", feature.id), {
            preserveScroll: true,
            onSuccess: () => {
                console.log("Form submitted successfully!");
            },
            onError: (errors) => {
                console.error("Form submission errors:", errors);
            },
        });
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Edit Feaure <b>{feature.name }</b>
                </h2>
            }
        >
            <Head title= {"update feature" + feature.name} />

            <div className="mb-4 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div className="p-6 text-gray-900 dark:text-gray-100 flex gap-8">
                    <form onSubmit={updateFeature} className="w-full">
                        <div className="mb-8">
                            <InputLabel htmlFor="name" value="Name" />

                            <TextInput
                                id="name"
                                className="mt-1 block w-full"
                                value={data.name}
                                onChange={(e) =>
                                    setData("name", e.target.value)
                                }
                                required
                                isFocused
                                autoComplete="name"
                            />

                            <InputError
                                className="mt-2"
                                message={errors.name}
                            />
                        </div>
                        <div className="mb-8">
                            <InputLabel
                                htmlFor="description"
                                value="Description"
                            />
                            <TextAreaInput
                                id="description"
                                className="mt-1 block w-full"
                                value={data.description}
                                onChange={(e) =>
                                    setData("description", e.target.value)
                                }
                                required
                                isFocused
                                autoComplete="description"
                            />

                            <InputError
                                className="mt-2"
                                message={errors.description}
                            />
                        </div>

                        <div className="flex items-center gap-4">
                            <PrimaryButton disabled={processing}>
                                Update
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}